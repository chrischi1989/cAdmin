<?php

namespace psnXT\Modules\User\Actions;

use psnXT\Modules\User\Models\User;
use psnXT\Modules\User\Tasks\AuthorizeActionTask;
use psnXT\Modules\User\Tasks\FindUserTask;
use psnXT\Modules\User\Tasks\SendCredentialEmailTask;
use psnXT\Modules\User\Tasks\StoreUserProfileTask;
use psnXT\Modules\User\Tasks\StoreUserTask;
use psnXT\Modules\User\Tasks\UpdateUserAccesslayerTask;
use psnXT\Modules\User\UI\Web\Requests\StoreRequest;
use Str;

/**
 * Class StoreAction
 * @package psnXT\Modules\User\Actions
 */
class StoreAction
{
    /**
     * @var FindUserTask
     */
    private $findUserTask;
    /**
     * @var StoreUserTask
     */
    private $storeUserTask;

    /**
     * @var StoreUserProfileTask
     */
    private $storeUserProfileTask;

    /**
     * @var UpdateUserAccesslayerTask
     */
    private $updateUserAccesslaerTask;
    /**
     * @var SendCredentialEmailTask
     */
    private $sendCredentialEmailTask;
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;

    /**
     * StoreAction constructor.
     * @param FindUserTask $findUserTask
     * @param StoreUserTask $storeUserTask
     * @param StoreUserProfileTask $storeUserProfileTask
     * @param UpdateUserAccesslayerTask $updateUserAccesslayerTask
     * @param SendCredentialEmailTask $sendCredentialEmailTask
     * @param AuthorizeActionTask $authorizeActionTask
     */
    public function __construct(
        FindUserTask $findUserTask,
        StoreUserTask $storeUserTask,
        StoreUserProfileTask $storeUserProfileTask,
        UpdateUserAccesslayerTask $updateUserAccesslayerTask,
        SendCredentialEmailTask $sendCredentialEmailTask,
        AuthorizeActionTask $authorizeActionTask
    ) {
        $this->findUserTask             = $findUserTask;
        $this->storeUserTask            = $storeUserTask;
        $this->storeUserProfileTask     = $storeUserProfileTask;
        $this->updateUserAccesslaerTask = $updateUserAccesslayerTask;
        $this->sendCredentialEmailTask  = $sendCredentialEmailTask;
        $this->authorizeActionTask      = $authorizeActionTask;

    }

    /**
     * @param StoreRequest $request
     * @return bool|mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run(StoreRequest $request)
    {
        $this->authorizeActionTask->run('create', User::class);
        $userData = $this->prepareUserData($request);

        if (!$this->storeUserTask->run($userData)) {
            return false;
        }

        $user = $this->findUserTask->byEmail($userData['email']);
        if (!$this->storeUserProfileTask->run($this->prepareUserProfileData($request, $user))) {
            return false;
        }

        if (!$this->updateUserAccesslaerTask->run($user, $request->post('accesslayer'),
            $this->prepareAccesslayerData($request))) {
            return false;
        }

        return $request->has('senddata') ? $this->sendCredentialEmailTask->run($user) : true;
    }

    /**
     * @param StoreRequest $request
     * @return array
     */
    private function prepareUserData(StoreRequest $request)
    {
        return [
            'tenant_uuid'           => $request->post('tenant'),
            'created_uuid'          => $request->user()->uuid,
            'updated_uuid'          => $request->user()->uuid,
            'activated_at'          => !$request->has('disabled') ? now() : null,
            'activated_uuid'        => !$request->has('disabled') ? $request->user()->uuid : null,
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
     * @param StoreRequest $request
     * @param User $user
     * @return array
     */
    private function prepareUserProfileData(StoreRequest $request, User $user)
    {
        return [
            'user_uuid'    => $user->uuid,
            'created_uuid' => $request->user()->uuid,
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
    private function prepareAccesslayerData(StoreRequest $request)
    {
        return [
            'created_uuid' => $request->user()->uuid,
            'updated_uuid' => $request->user()->uuid
        ];
    }
}
