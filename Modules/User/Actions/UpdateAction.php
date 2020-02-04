<?php

namespace Modules\User\Actions;

use Str;
use Modules\User\Tasks\UpdateUserAccesslayerTask;
use Modules\User\Tasks\UpdateUserProfileTask;
use Modules\User\UI\Web\Requests\UpdateRequest;
use Modules\User\Models\User;
use Modules\User\Tasks\AuthorizeActionTask;
use Modules\User\Tasks\FindUserTask;
use Modules\User\Tasks\UpdateUserTask;
use Modules\User\UI\Web\Requests\StoreRequest;

/**
 * Class UpdateAction
 * @package Modules\User\Actions
 */
class UpdateAction
{
    /**
     * @var FindUserTask
     */
    private $findUserTask;
    /**
     * @var UpdateUserTask
     */
    private $updateUserTask;
    /**
     * @var UpdateUserProfileTask
     */
    private $updateUserProfileTask;
    /**
     * @var UpdateUserAccesslayerTask
     */
    private $updateUserAccesslayerTask;
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;

    /**
     * UpdateAction constructor.
     * @param FindUserTask $findUserTask
     * @param UpdateUserTask $updateUserTask
     * @param UpdateUserProfileTask $updateUserProfileTask
     * @param UpdateUserAccesslayerTask $updateUserAccesslayerTask
     * @param AuthorizeActionTask $authorizeActionTask
     */
    public function __construct(
        FindUserTask $findUserTask,
        UpdateUserTask $updateUserTask,
        UpdateUserProfileTask $updateUserProfileTask,
        UpdateUserAccesslayerTask $updateUserAccesslayerTask,
        AuthorizeActionTask $authorizeActionTask
    ) {
        $this->findUserTask              = $findUserTask;
        $this->updateUserTask            = $updateUserTask;
        $this->updateUserProfileTask     = $updateUserProfileTask;
        $this->updateUserAccesslayerTask = $updateUserAccesslayerTask;
        $this->authorizeActionTask       = $authorizeActionTask;
    }

    /**
     * @param UpdateRequest $request
     * @return bool
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run(UpdateRequest $request)
    {
        $this->authorizeActionTask->run('edit', User::class);

        $user                = $this->findUserTask->byUuid($request->post('uuid'), ['profile']);
        $userData            = $this->prepareUserData($request);
        $userProfileData     = $this->prepareUserProfileData($request);
        $userAccesslayerData = $this->prepareAccesslayerData($request);

        if (!$this->updateUserTask->run($user, $userData)) {
            return false;
        }

        if (!$this->updateUserProfileTask->run($user->profile, $userProfileData)) {
            return false;
        }

        if (!$this->updateUserAccesslayerTask->run($user, $request->post('accesslayer'), $userAccesslayerData)) {
            return false;
        }

        return true;
    }

    /**
     * @param UpdateRequest $request
     * @return array
     */
    private function prepareUserData(UpdateRequest $request)
    {
        return [
            'tenant_uuid'           => $request->post('tenant'),
            'updated_uuid'          => $request->user()->uuid,
            'deactivated_at'        => $request->has('disabled') ? now() : null,
            'deactivated_uuid'      => $request->has('disabled') ? $request->user()->uuid : null,
            'email'                 => $request->post('email'),
            'password'              => $request->post('password'),
            'activation_token'      => Str::random(),
            'failed_logins_max'     => $request->post('failed_logins_max'),
            'password_expires'      => $request->has('password_expires'),
            'password_expires_days' => $request->post('password_expires_days')
        ];
    }

    /**
     * @param UpdateRequest $request
     * @return array
     */
    private function prepareUserProfileData(UpdateRequest $request)
    {
        return [
            'updated_uuid' => $request->user()->uuid,
            'salutation'   => $request->post('salutation'),
            'title'        => $request->post('title'),
            'firstname'    => $request->post('firstname'),
            'lastname'     => $request->post('lastname'),
            'street'       => $request->post('street'),
            'housenumber'  => $request->post('housenumber'),
            'postalcode'   => $request->post('postalcode'),
            'location'     => $request->post('location'),
            'telephone'    => $request->post('telephone'),
            'cellphone'    => $request->post('cellphone')
        ];
    }

    /**
     * @param StoreRequest $request
     * @return array
     */
    private function prepareAccesslayerData(UpdateRequest $request)
    {
        return [
            'created_uuid' => $request->user()->uuid,
            'updated_uuid' => $request->user()->uuid
        ];
    }
}
