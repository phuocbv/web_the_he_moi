<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface CollectionRepositoryInterface extends RepositoryInterface
{
    public function getProducts($id, $from, $to);

    public function getMyCollections($shop_id, $currentPage, $limit);

    public function updateCollection($id, $data);
}
