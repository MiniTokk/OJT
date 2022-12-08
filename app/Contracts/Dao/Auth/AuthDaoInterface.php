<?php

namespace App\Contracts\Dao\Auth;

interface AuthDaoInterface
{
  /**
   * Register and create user
   * @param mixed $request
   * @return mixed
   */
  public function registerToCreateUser($request);
}