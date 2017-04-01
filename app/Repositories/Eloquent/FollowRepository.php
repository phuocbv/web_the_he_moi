<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\FollowRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Follow;

class FollowRepository extends BaseRepository implements FollowRepositoryInterface
{
    public function model()
    {
        return Follow::class;
    }
}
