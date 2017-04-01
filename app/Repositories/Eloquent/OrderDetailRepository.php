<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\OrderDetailRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\OrderDetail;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{
    public function model()
    {
        return OrderDetail::class;
    }
}
