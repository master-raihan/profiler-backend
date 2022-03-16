<?php

namespace App\Repositories;

use App\Contracts\Repositories\AuthRepository;
use App\Repositories\BaseRepository\BaseRepository;
use Illuminate\Support\Facades\Auth;

class AuthRepositoryEloquent extends BaseRepository implements AuthRepository
{
    protected function model()
    {
        //
    }

    public function login($user)
    {
        return Auth::attempt($user);
    }
}
