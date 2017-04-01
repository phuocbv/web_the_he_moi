<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CollectionRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Collection;
use App\CollectionValidator;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Lang;

class CollectionRepository extends BaseRepository implements CollectionRepositoryInterface
{
    public function model()
    {
        return Collection::class;
    }

    public function validate($data, $ruleName)
    {
        return $this->model->validate($data, $ruleName);
    }

    public function valid()
    {
        return $this->model->valid();
    }

    public function getProducts($id, $from, $to)
    {
        $collection = $this->model->find($id);
        if ($collection) {
            return $collection->products()
                ->whereBetween('price', [$from, $to])->get();
        }

        return null;
    }

    public function getMyCollections($shop_id, $currentPage, $limit)
    {
        $data['sum'] = $this->model->where('shop_id', $shop_id)->get();
        if (count($data['sum']) > 0) {
            $data['collections'] = $this->model->where('shop_id', $shop_id)->offset($currentPage * $limit)
                ->limit($limit)->get();
        } else {
            $data['collections'] = null;
        }

        return $data;
    }

    public function updateCollection($id, $data)
    {
        try {
            DB::beginTransaction();
            if ($this->model->find($id)->update($data)) {
                DB::commit();

                return ['status' => 'success', 'data' => $data];
            }
            DB::rollback();
        } catch (Exception $e) {
            DB::rollback();
        }

        return ['status' => 'no-success'];
    }
}
