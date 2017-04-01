<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\CategoryRepositoryInterface as CategoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface as ProductInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $categoryRepository;
    private $productRepository;

    public function __construct(
        CategoryInterface $categoryInterface,
        ProductInterface $productInterface)
    {
        $this->categoryRepository = $categoryInterface;
        $this->productRepository = $productInterface;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = $this->categoryRepository->getCategory(config('view.take-category'));

        return view('home', $data);
    }

    public function searchProduct(Request $request)
    {
        $param = $request->only('page', 'search');
        if ($param['page']) {
            $page = $param['page'];
        } else {
            $page = 1;
        }
        $data = $this->productRepository
            ->searchProductByName($param['search'], ($page - 1), config('view.panigate-24'));
        $data['categories'] = $this->categoryRepository->getCategory(config('view.take-category'));
        if ($request->ajax()) {
            return response()->json(view('itemProducts', $data)->render());
        }

        return view('searchProduct', $data);
    }
}
