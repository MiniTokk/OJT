<?php

namespace App\Contracts\Services\Auth;

interface AuthServiceInterface
{
    /**
     * Register and create user
     * @param mixed $request
     * @return mixed
     */
    public function registerToCreateUser($request);
}

