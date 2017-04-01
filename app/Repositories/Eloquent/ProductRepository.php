<?php 

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Container\Container as Application;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface 
{
    public function model()
    {
        return Product::class;
    }

    public function searchProductByName($name, $currentPage, $limit)
    {
        $products = $this->model->where('name', 'like', '%' . $name . '%')->orderBy('created_at', 'desc');
        $data['sum'] = count($products->get());
        if ($data['sum'] > 0) {
            $data['products'] = $products->offset($currentPage * $limit)->limit($limit)->get();
        } else {
            $data['products'] = null;
        }

        return $data;
    }

    public function getSimilarProduct(Product $product, $limit)
    {
        return $this->model->where('category_id', $product->category_id)
            ->where('id', '<>', $product->id)
            ->orderBy('created_at', 'desc')->limit($limit);
    }
}
