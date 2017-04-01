<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ReceiverRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Receiver;

class ReceiverRepository extends BaseRepository implements ReceiverRepositoryInterface
{
    public function model()
    {
        return Receiver::class;
    }

    public function validate($data, $ruleName)
    {
        return $this->model->validate($data, $ruleName);
    }
}
