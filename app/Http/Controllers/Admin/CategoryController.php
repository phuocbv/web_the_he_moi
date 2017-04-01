<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\CategoryValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;    

use App\Repositories\Contracts\CategoryRepositoryInterface as CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepository;

    protected $categoryValidator;

    public function __construct(
        CategoryRepository $categoryRepository,
        CategoryValidator $categoryValidator)
    {
       $this->categoryRepository = $categoryRepository;
       $this->categoryValidator = $categoryValidator;
    }

    public function index(Request $request)
    {
        $data['categories'] = $this->categoryRepository->paginate(config('view.panigate-10'));
        if ($request->ajax()) {
            return response()->json(view('admin.category.listCategories', $data)->render());
        }

        return view('admin.category.index', $data);
    }

    public function create()
    {
        $parents = $this->categoryRepository->getParents();

        return view('admin.category.create', compact('parents', 'sorts'));
    }

    public function store(Request $request)
    {
        $data = $request->only('name', 'parent_id', 'sort');
        if ($data['parent_id'] == 0) {
            unset($data['parent_id']);
        }
        return $this->categoryRepository->create($data);
    }

    public function edit(Request $request, $id)
    {
        $data['category'] = $this->categoryRepository->find($id);
        $data['rootCategories'] = $this->categoryRepository->findWhere(['parent_id' => null]);
        if ($request->ajax()) {
            return response()->json(view('admin.category.itemEdit', $data)->render());
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('name', 'sort', 'parent_id');
        $category = $this->categoryRepository->find($id);
        if ($category) {
            try {
                $this->categoryValidator->setId($id);
                if ($this->categoryValidator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE)) {
                    DB::beginTransaction();
                    $result = $this->categoryRepository->update($data, $id);
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
        }

        return response()->json(['status' => 'error']);
    }

    public function subCategory()
    {
        $subs = $this->categoryRepository->getSubCategory($id);
    }
}
