<?php

namespace App\Services\Auth;

use App\Contracts\Dao\Auth\AuthDaoInterface;
use App\Contracts\Services\Auth\AuthServiceInterface;


class AuthService implements AuthServiceInterface
{
  private $authDao;

  public function __construct(AuthDaoInterface $authDao)
  {
    $this->authDao = $authDao;
  }

  /**
   * Register And Create User
   * @param mixed $request
   * @return mixed
   */
  public function registerToCreateUser($request)
  {
    return $this->authDao->registerToCreateUser($request);
  }
}
