<?php

namespace App\Repositories\Eloquent;

use App\ProductCollectionValidator;
use App\ProductValidator;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Container\Container as Application;
use Illuminate\Exception;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Product;
use App\Models\Image;
use App\Models\ProductCollection;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected $productValidator;
    protected $productCollectionValidator;

    public function __construct(
        Application $app,
        ProductValidator $productValidator,
        ProductCollectionValidator $productCollectionValidator)
    {
        parent::__construct($app);
        $this->productValidator = $productValidator;
        $this->productCollectionValidator = $productCollectionValidator;
    }

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

    public function storeProduct($data = [])
    {
        DB::beginTransaction();
        try {
            if (!$this->productValidator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE)) {
                return false;
            }

            $product = $this->create($data);

            foreach ($data['images'] as $key => $value) {
                $image = [
                    'product_id' => $product->id,
                    'url' => $value
                ];
                Image::create($image);
            }

            $productCollection = [
                'product_id' => $product->id,
                'collection_id' => $data['collection']
            ];

            if ($this->productCollectionValidator->with($productCollection)->passesOrFail()) {
                ProductCollection::create($productCollection);
                DB::commit();

                return $product;
            }
        } catch (ValidatorException $e) {
            DB::rollBack();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return false;
    }
}
