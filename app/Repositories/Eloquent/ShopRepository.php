<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ShopRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Shop;
use Carbon\Carbon;
use Lang;

class ShopRepository extends BaseRepository implements ShopRepositoryInterface
{
    public function model()
    {
        return Shop::class;
    }

    private function validate($data, $ruleName)
    {
        return $this->model->validate($data, $ruleName);
    }

    public function create(array $data)
    {
        if ($this->validate($data, 'create')) {
            $this->model->create($data);
        }
        
        return redirect()->back()->withErrors($this->model->valid());
    }

    public function getListOrderedProducts($id, $dateFrom, $dateTo)
    {   
        $shop = $this->model->find($id);
        if (!$shop) {
            return null;
        }
        if ($dateFrom && $dateTo) {
            return $orededProducts = $shop->orderDetails()
                ->whereBetween('order_details.created_at', [
                    Carbon::createFromFormat('Y-m-d', $dateFrom)->toDateTimeString(),
                    Carbon::createFromFormat('Y-m-d', $dateTo)->toDateTimeString()
                ])->get();
        }

        return $shop->orderDetails;
    }
}
