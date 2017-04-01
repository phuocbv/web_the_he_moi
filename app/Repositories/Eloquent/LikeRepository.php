<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\LikeRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Like;
use Lang;

class LikeRepository extends BaseRepository implements LikeRepositoryInterface
{
    public function model()
    {
        return Like::class;
    }
}
