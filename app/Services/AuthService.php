<?php

namespace App\Services;

use App\Contracts\Repositories\AuthRepository;
use App\Contracts\Services\AuthContract;
use App\Helpers\UtilityHelper;

class AuthService implements AuthContract
{
    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login($request)
    {
        try{
            $credentials = $request->only(['email', 'password']);
            if (! $token = $this->authRepository->login($credentials)) {
                return UtilityHelper::RETURN_ERROR_FORMAT(
                    401,
                    'Unauthorized Access!',
                );
            }

            return UtilityHelper::RETURN_SUCCESS_FORMAT(
                200,
                'User Successfully Authenticated!',
                $this->respondWithToken($token)
            );
        }catch (Exception $exception){
            return UtilityHelper::RETURN_ERROR_FORMAT(
                500
            );
        }
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
