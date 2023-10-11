<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        return view('admin.categories.categoriesView',['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.categories.categoriesFormView');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories',
        ]);
        $this->categoryRepository->create($request);
        return redirect(route('categories.index'));
    }
    
    public function edit($id)
    {
        $record = $this->categoryRepository->getOne($id);
        return view('admin.categories.categoriesFormView',['record' => $record]);

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $this->categoryRepository->update($request, $id);
        return redirect(route('categories.index'));
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return redirect(route('categories.index'));
    }
}
