<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\CategoryRepositoryInterface as CategoryInterface;

class CategoriesControllers extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryRepository = $categoryInterface;
    }

    public function showProductInCategory($id)
    {
        $category = $this->categoryRepository->find($id);
        $data['categoryShow'] = $category;
        $data['categories'] = $this->categoryRepository->getCategory(config('view.take-category'));

        return view('category', $data);
    }

    public function searchProduct(Request $request, $id)
    {
        $data = $request->only('to', 'from');
        $products = $this->categoryRepository->getProducts($id, $data['from'], $data['to']);
        if ($products) {
            return view('products.listProducts')->with('products', $products);
        }

        return 'not-found-category';
    }

    public function searchProductInCategory(Request $request, $id)
    {
        $data['categoryShow'] = $category = $this->categoryRepository->find($id);
        $data['categories'] = $this->categoryRepository->getCategory(config('view.take-category'));
        if ($category) {
            if ($category->parent_id == null) {
                $data['products'] = $this->categoryRepository->find($id)->allProductsByCate()->paginate(config('view.panigate-24'));
            } else {
                $data['products'] = $this->categoryRepository->find($id)->products()->paginate(config('view.panigate-24'));
            }
            if ($request->ajax()) {
                return response()->json(view('listProducts', $data)->render());
            }
            
            return view('productInCategory', $data);
        }
    }
}
