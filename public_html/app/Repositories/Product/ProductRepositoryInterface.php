<?php 
namespace App\Repositories\Product;

interface ProductRepositoryInterface{
	
	public function getAll();

    public function getOne($id);

	public function create($request, $imgData);

    public function update($request, $id, $imgData);

    public function delete($id);

    public function search($request);

    public function inventory();
    
}