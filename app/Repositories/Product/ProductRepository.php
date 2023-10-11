<?php 
namespace App\Repositories\Product;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

	public function getAll()
    {
		return $this->product->with('category')->orderByDesc('created_at')->paginate(20);
	}

    public function getOne($id)
    {
        return $this->product->findOrFail($id);
    }

	public function create($request, $imgData)
    {
        $this->product->create([
            'image'=>  implode("|",$imgData),
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'discount' => $request->discount,
            'remaining' => $request->remaining,
            'display_home' => $request->display_home,
            'category_id' => $request->category_id,
        ]);
    }

    public function update($request, $id, $imgData)
    {
        $this->product->find($id)->update([
            'image'=>  implode("|",$imgData),
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'discount' => $request->discount,
            'remaining' => $request->remaining,
            'display_home' => $request->display_home,
            'category_id' => $request->category_id,
        ]);
    }

    public function delete($id)
    {
		return $this->product->destroy($id);
	}

    public function search($request)
    {
        return $this->product->where('name','like', '%'.$request->search.'%')->paginate(20);
    }

    public function inventory()
    {
        return $this->product->where('remaining', '>', 0)->paginate(20);
    }

}