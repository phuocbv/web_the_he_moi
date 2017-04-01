<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Repositories\Contracts\ProductRepositoryInterface as ProductInterface;
use App\Repositories\Contracts\RateRepositoryInterface as RateInterface;
use App\Repositories\Contracts\FollowRepositoryInterface as FollowInterface;
use App\Repositories\Contracts\ImageRepositoryInterface as ImageInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface as CategoryInterface;
use App\Repositories\Contracts\ProductCollectionRepositoryInterface as ProductCollectionInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Exception;
use App\ProductCollectionValidator;
use App\ProductValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Auth;

class ProductController extends Controller
{
    private $productRepository;
    private $rateRepository;
    private $productCollectionRepository;
    private $followRepository;
    private $imageRepository;
    private $categoryRepository;

    protected $productCollectionValidator;
    protected $productValidator;

    public function __construct(
        ProductInterface $productInterface,
        RateInterface $rateInterface,
        FollowInterface $followInterface,
        ProductCollectionInterface $productCollectionInterface,
        ProductCollectionValidator $productCollectionValidator,
        ProductValidator $productValidator,
        ImageInterface $imageInterface,
        CategoryInterface $categoryInterface)
    {
        $this->productRepository = $productInterface;
        $this->rateRepository = $rateInterface;
        $this->followRepository = $followInterface;
        $this->productCollectionRepository = $productCollectionInterface;
        $this->productCollectionValidator = $productCollectionValidator;
        $this->productValidator = $productValidator;
        $this->imageRepository = $imageInterface;
        $this->categoryRepository = $categoryInterface;
    }

    public function show($id)
    {
        $data['product'] = $this->productRepository->find($id);
        if ($data['product']) {
            $data['similarProducts'] = $this->productRepository
                ->getSimilarProduct($data['product'], config('view.similar-product'))->get();
            if (Auth::user()) {
                $data['followed'] = count($this->followRepository->findWhere([
                    'user_id' => Auth::id(),
                    'shop_id' => $data['product']->shop->id
                ]));
            }
        }

        return view('products.show', $data);
    }

    public function store(Request $request)
    {
        $data = $request->only('name', 'category_id', 'price', 'code',
            'quantity', 'discount', 'description', 'status', 'collection', 'images');
        $data = array_collapse([$data, ['shop_id' => Auth::user()->shop->id]]);
        try {
            if ($this->productValidator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE)) {
                DB::beginTransaction();
                $product = $this->productRepository->create($data);
                foreach ($data['images'] as $key => $value) {
                    $image = ['product_id' => $product->id, 'url' => $value];
                    $this->imageRepository->create($image);
                }
                $productCollection = ['product_id' => $product->id, 'collection_id' => $data['collection']];
                if ($this->productCollectionValidator->with($productCollection)->passesOrFail()) {
                    $this->productCollectionRepository->create($productCollection);
                    DB::commit();

                    return response()->json(['status' => 'success', 'data' => $product]);
                }
                DB::rollback();
            }
        } catch (ValidatorException $e) {
            DB::rollback();
        } catch (Exception $e) {
            DB::rollback();
        }

        return response()->json(['status' => 'error']);
    }

    public function destroy($id)
    {
        if (!$this->productRepository->find($id)) {
            return response()->json('not-found');
        }
        if ($this->productRepository->delete($id)) {
            $result = 'success';
        } else {
            $result = 'error';
        }

        return response()->json($result);
    }

    public function addRate(Request $request, $id)
    {
        $data = $request->only('number', 'content');
        $arrayId = ['product_id' => $id, 'user_id' => Auth::id()];
        $count = count($this->rateRepository->findWhere($arrayId));
        $data = array_collapse([$data, $arrayId]);
        $product = $this->productRepository->find($id);
        if (count($product) == 0) {

            return response()->json('not-product');
        }
        if ($count > 0) {

            return response()->json('rated');
        }
        if (Auth::user() && $this->rateRepository->validate($data, 'create')) {
            DB::beginTransaction();
            try {
                $this->rateRepository->create($data);
                $rates = $product->rates;
                $number = round(($rates->sum('number')) / count($rates), 1);
                $message = $this->productRepository->update(['point_rate' => $number], $id);
                DB::commit();

                return response()->json($message);
            } catch (Exception $e) {
                DB::rollback();
            }
        }

        return response()->json('error');
    }
}
