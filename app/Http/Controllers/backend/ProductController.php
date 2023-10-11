<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
class ProductController extends Controller
{
    protected $productRepository, $categoryRepository;
    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {   
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {
        $products = $this->productRepository->getAll();
        return view('admin.products.productsView',['products' => $products]);
    }

    public function create()
    {
        $categories = $this->categoryRepository->getAll();
        return view('admin.products.productsFormView', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'imageFile' => 'required',
            'imageFile.*' => 'mimes:jpeg,jpg,png|max:2048',
            'name' => 'required|max:255|unique:products',
            'price' => 'required|numeric',
            'discount' => 'required|numeric|min:0|max:100',
            'description' => 'required',
            'remaining' => 'required|numeric',
        ]);
        if($request->has('imageFile')) {
            foreach($request->file('imageFile') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move(public_path().'/uploads/',$name);  
                $imgData[] = $name;  
            }
        }
                
        $this->productRepository->create($request,$imgData);
        return redirect(route('products.index'));
    }

    public function show($id)
    {
        $product = $this->productRepository->getOne($id);
        return view('admin.products.productsDetailView',['product' => $product]);
    }

    public function edit($id)
    {
        $categories = $this->categoryRepository->getAll();
        $record = $this->productRepository->getOne($id);
        return view('admin.products.productsFormView',['record' => $record, 'categories' => $categories]);

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'imageFile.*' => 'mimes:jpeg,jpg,png|max:2048',
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'discount' => 'required|numeric|min:0|max:100',
            'description' => 'required',
            'remaining' => 'required|numeric',
        ]);
        $imgData = [];
        if(empty($request->imageFile)) {
            $record = $this->productRepository->getOne($id);
            $imgData = explode('|',$record->image);
        } else {
            foreach($request->file('imageFile') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move(public_path().'/uploads/',$name);  
                $imgData[] = $name;  
            }
        }
        $this->productRepository->update($request, $id, $imgData);
        return redirect(route('products.index'));
    }

    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return redirect(route('products.index'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|max :255'
        ]);
        $products = $this->productRepository->search($request);
        return view('admin.products.productsView',['products' => $products]);
    }

    public function inventory()
    {
        $products = $this->productRepository->inventory();
        return view('admin.products.inventoryView',['products' => $products]);
    }
}
