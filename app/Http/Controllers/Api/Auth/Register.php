<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\User\UserCreator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register as RegisterRequest;

class Register extends Controller
{
    public function __invoke(RegisterRequest $request,UserCreator $creator)
    {
        $user = $creator->create(
            $request->validated()
        );

        return res([
            'success' => true,
            'user' => $user,
            'token' => $user->createToken($request->device_id,['permissions' => 'will:be:key:value:pair'])->plainTextToken
        ]);
    }
}
