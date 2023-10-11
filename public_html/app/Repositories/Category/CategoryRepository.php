<?php 
namespace App\Repositories\Category;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

	public function getAll()
    {
		return $this->category->all();
	}

    public function getOne($id)
    {
        return $this->category->findOrFail($id);
    }

	public function create($request)
    {
        $this->category->create([
            'name' => $request->name,
            'display_home' => $request->display_home
        ]);
    }

    public function update($request, $id)
    {
       $this->category->find($id)->update([
            'name' => $request->name,
            'display_home' => $request->display_home,
        ]);
    }

    public function delete($id)
    {
		return $this->category->destroy($id);
	}

}