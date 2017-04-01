<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface RateRepositoryInterface extends RepositoryInterface
{
    public function validate($data, $ruleName);
}
