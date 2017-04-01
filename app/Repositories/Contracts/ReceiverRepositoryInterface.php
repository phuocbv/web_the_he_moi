<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface ReceiverRepositoryInterface extends RepositoryInterface
{
    public function validate($data, $ruleName);
}
