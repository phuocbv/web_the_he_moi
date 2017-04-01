<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RateRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Rate;
use Lang;

class RateRepository extends BaseRepository implements RateRepositoryInterface
{
    public function model()
    {
        return Rate::class;
    }

    public function validate($data, $ruleName)
    {
        return $this->model->validate($data, $ruleName);
    }
}
