<?php

namespace psnXT\Modules\User\Tasks;

use psnXT\Modules\User\Models\Profile;

/**
 * Class StoreUserProfileTask
 * @package psnXT\Modules\User\Tasks
 */
class StoreUserProfileTask
{
    /**
     * @var Profile
     */
    private $profile;

    /**
     * StoreUserProfileTask constructor.
     * @param Profile $profile
     */
    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * @param $data
     * @return bool
     */
    public function run($data)
    {
        if (!isset($data['user_uuid'], $data['created_uuid'], $data['updated_uuid'])) {
            return false;
        }

        $this->profile->user_uuid    = $data['user_uuid'];
        $this->profile->created_uuid = $data['created_uuid'];
        $this->profile->updated_uuid = $data['updated_uuid'];
        $this->profile->salutation   = $data['salutation'];
        $this->profile->title        = $data['title'] ?? null;
        $this->profile->firstname    = $data['firstname'];
        $this->profile->lastname     = $data['lastname'];
        $this->profile->street       = $data['street'] ?? null;
        $this->profile->housenumber  = $data['housenumber'] ?? null;
        $this->profile->postalcode   = $data['postalcode'] ?? null;
        $this->profile->location     = $data['location'] ?? null;
        $this->profile->telephone    = $data['telephone'] ?? null;
        $this->profile->cellphone    = $data['cellphone'] ?? null;

        return $this->profile->save();
    }
}
