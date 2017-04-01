<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getParents();

    public function getSubCategory($id);

    //get list category view in home menu
    public function getCategory($take);

    public function getProducts($category, $from, $to);
}
