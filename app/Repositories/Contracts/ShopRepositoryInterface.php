<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface ShopRepositoryInterface extends RepositoryInterface
{
    public function getListOrderedProducts($id, $dateFrom, $dateTo);
}
