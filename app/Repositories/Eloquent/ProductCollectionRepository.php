<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProductCollectionRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\ProductCollection;

class ProductCollectionRepository extends BaseRepository implements ProductCollectionRepositoryInterface
{
    public function model()
    {
        return ProductCollection::class;
    }
}
