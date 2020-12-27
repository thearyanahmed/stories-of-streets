<?php


namespace App\Actions\User;

use App\Models\User;

class UserCreator
{
    public function create(array $data)
    {
        $data['password'] = \Hash::make($data['password']);
        $user = User::create($data);

        // log user
//        activity()->causedBy($user)->log('Registered.');

        return $user;
    }
}
