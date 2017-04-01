<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ImageRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Image;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    public function model()
    {
        return Image::class;
    }
}
