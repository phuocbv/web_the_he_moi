<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function validate($data, $ruleName);

    public function findOrCreateUser($provider, $user);

    public function login($data);

    public function getCurrentUser();
}
