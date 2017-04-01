<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CollectionRepositoryInterface as CollectionRepositoryInterface;
use App\Repositories\Contracts\ShopRepositoryInterface as ShopRepositoryInterface;
use App\Repositories\Contracts\ProductCollectionRepositoryInterface as ProductCollectionInterface;
use App\ProductCollectionValidator;
use App\CollectionValidator;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

use Auth;
use Lang;

class CollectionController extends Controller
{
    private $collectionRepository;
    private $shopRepository;
    private $productCollectionRepository;
    protected $productCollectionValidator;
    protected $collectionValidator;

    public function __construct(
        ShopRepositoryInterface $shopRepository,
        CollectionRepositoryInterface $collectionRepository,
        ProductCollectionInterface $productCollectionInterface,
        ProductCollectionValidator $productCollectionValidator,
        CollectionValidator $collectionValidator
    )
    {
        $this->shopRepository = $shopRepository;
        $this->collectionRepository = $collectionRepository;
        $this->productCollectionRepository = $productCollectionInterface;
        $this->productCollectionValidator = $productCollectionValidator;
        $this->collectionValidator = $collectionValidator;
    }

    public function index()
    {
        $collections = $this->collectionRepository->findByField('shop_id', Auth::user()->shop->id);

        return view('user.collection.index', compact('collections'));
    }

    public function create()
    {
        return view('user.collection.index');
    }

    public function store(Request $request)
    {
        $data = $request->only('name');
        if (!Auth::user()->shop()) {
            return response()->json(['status' => 'no-shop']);
        }   
        $data['shop_id'] = Auth::user()->shop->id;
        try {
            if ($this->collectionValidator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE)) {
                DB::beginTransaction();
                $result = $this->collectionRepository->create($data);
                if ($result) {
                    DB::commit();

                    return response()->json(['status' => 'success', 'data' => $result]);
                }
                DB::rollback();
            }
        } catch (ValidatorException $e) {
            return response()->json([
                'status' => 'validator',
                'message' => $e->getMessageBag()
            ]);
            DB::rollback();
        } catch (Exception $e) {
            DB::rollback();
        }

        return response()->json(['status' => 'error']);
    }

    public function postUpdateAjax(Request $request)
    {
        $data = $request->only('name');
        if (!$request->id) {
            return response()->json(['sms' => Lang::get('user.sms.not_found')]);
        }
        $this->collectionRepository->update($data, $request->id);
        
        return response()->json(['sms' => Lang::get('user.sms.update')]);
    }

    public function postDeleteAjax(Request $request)
    {
        if (!$request->id) {
            return response()->json(['sms' => Lang::get('user.sms.not_found')]);
        }
        $this->collectionRepository->delete($request->id);

        return response()->json(['sms' => Lang::get('user.sms.delete')]);
    }

    public function show($id)
    {   
        $collection = $this->collectionRepository->find($id);
        $shop = $this->shopRepository->findByField('user_id', Auth::id())->first();
            
        return view('user.collection.show', compact('collection', 'shop'));
    }

    public function edit(Request $request, $id)
    {
        $data['collection'] = $this->collectionRepository->find($id);
        if ($request->ajax()) {
            if ($data['collection']) {
                return response()->json(['status' => 'success',
                    'data' => $data['collection']->toArray()]);
            }
        }

        return response()->json(['status' => 'error']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('name');
        $collection = $this->collectionRepository->find($id);
        if ($request->ajax()) {
            if ($collection) {
                try {
                    $this->collectionValidator->setId($id);
                    if ($this->collectionValidator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE)) {
                        return response()->json($this->collectionRepository->updateCollection($id, $data));
                    }
                } catch (ValidatorException $e) {
                    return response()->json([
                        'status' => 'validator',
                        'message' => $e->getMessageBag()
                    ]);
                }
            }
        }

        return response()->json(['status' => 'error']);
    }

    public function destroy($id)
    {
        $collection = $this->collectionRepository->find($id);
        if ($collection) {
            try {
                DB::beginTransaction();
                if ($this->collectionRepository->delete($id)) {
                    DB::commit();

                    return response()->json(['status' => 'success']);
                }
                DB::rollback();
            } catch (Exception $e) {
                DB::rollback();
            }
        }

        return response()->json(['status' => 'error']);
    }

    public function addProduct(Request $request)
    {
        $data = $request->only('product_id', 'collection_id');
        $productCollection = ['product_id' => $data['product_id'], 'collection_id' => $data['collection_id']];
        if ($this->productCollectionValidator->with($productCollection)->passesOrFail()) {
            $count = $this->productCollectionRepository->findWhere($productCollection)->count();
            if ($count == 0) {
                    $this->productCollectionRepository->create($productCollection);
                    $collection = $this->collectionRepository->find($data['collection_id']);
                    $shop = $this->shopRepository->findByField('user_id', Auth::id())->first();

                    return view('user.collection.collection', compact('collection', 'shop'));
            } else {

                return Lang::get('user.collection.add-warning');
            }
        }

        return Lang::get('user.collection.add-error');
    }

    public function removeProduct(Request $request)
    {
        $data = $request->only('product_id', 'collection_id');
        $where = ['product_id' => $data['product_id'], 'collection_id' => $data['collection_id']];
        $productCollection = $this->productCollectionRepository->findWhere($where)->first();
        if ($productCollection) {
            $productCollection->delete();
            $collection = $this->collectionRepository->find($data['collection_id']);
            $shop = $this->shopRepository->findByField('user_id', Auth::id())->first();

            return view('user.collection.collection', compact('collection', 'shop'));
        }
        
        return Lang::get('remove-error');
    }

    public function myCollection(Request $request)
    {
        $param = $request->only('page');
        if ($param['page']) {
            $page = $param['page'];
        } else {
            $page = 1;
        }
        $data = $this->collectionRepository
            ->getMyCollections(Auth::user()->shop->id, ($page - 1), config('view.panigate-10'));
        $data['page'] = $param['page'];
        if ($request->ajax()) {
            return response()->json(view('seller-chanel.itemCollection', $data)->render());
        }

        return view('seller-chanel.myCollection', $data);
    }
}
