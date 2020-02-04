<?php

namespace Modules\User\Tasks;

use Modules\User\Models\Profile;

class UpdateUserProfileTask
{
    public function run(Profile $profile, $data)
    {
        $profile->updated_uuid = $data['updated_uuid'];
        $profile->salutation   = $data['salutation'];
        $profile->title        = $data['title'] ?? null;
        $profile->firstname    = $data['firstname'];
        $profile->lastname     = $data['lastname'];
        $profile->street       = $data['street'] ?? null;
        $profile->housenumber  = $data['housenumber'] ?? null;
        $profile->postalcode   = $data['postalcode'] ?? null;
        $profile->location     = $data['location'] ?? null;
        $profile->telephone    = $data['telephone'] ?? null;
        $profile->cellphone    = $data['cellphone'] ?? null;

        return $profile->save();
    }
}
