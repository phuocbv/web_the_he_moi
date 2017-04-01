<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ShopRepositoryInterface as ShopRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface as CategoryRepositoryInterface;
use Auth;

class ShopController extends Controller
{
    private $shopRepository;
    private $categoryRepository;

    public function __construct(
        ShopRepositoryInterface $shopRepository, 
        CategoryRepositoryInterface $categoryRepository
    )
    {
       $this->shopRepository = $shopRepository;
       $this->categoryRepository = $categoryRepository;
    }

    public function create()
    {
        if (count($this->shopRepository->findByField('user_id', Auth::user()->id)) > 0) {
            return redirect()->to('/');
        }
        $categories = $this->categoryRepository->findWhere(['parent_id' => null], ['name', 'id']);

        return view('user.shop.create-shop', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->only('name', 'address', 'description', 'category_id');
        $data['status'] = config('view.number.zero');
        $data['user_id'] = Auth::user()->id;

        return $this->shopRepository->create($data);
    }

    public function show($id)
    {
        $shop = $this->shopRepository->find($id);

        return view('user.shop.show-shop', compact('shop'));
    }

    public function showShopOfUser()
    {
        if (Auth::user()) {
            $data['shop'] = $this->shopRepository->findByField('user_id', Auth::id())->first();

            return view('seller-chanel.listProducts', $data);
        }

        return redirect()->route('/');
    }

    public function myShop()
    {
        if (Auth::user()) {
            return view('seller-chanel.myShop');
        }

        return redirect()->route('/');
    }
}
