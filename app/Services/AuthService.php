<?php

namespace App\Services;

use App\Contracts\Repositories\AuthRepository;
use App\Contracts\Services\AuthContract;

class AuthService implements AuthContract
{
    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login($request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = $this->authRepository->login($credentials)) {
            return ['message' => 'Unauthorized'];
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => auth()->user()
        ];
    }
}
