<?php 
namespace App\Repositories\Category;

interface CategoryRepositoryInterface{
	
	public function getAll();

    public function getOne($id);

	public function create($request);

    public function update($request, $id);

    public function delete($id);

}