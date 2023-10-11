<?php 
namespace App\Repositories\User;

interface UserRepositoryInterface{
	
	public function getAll();

    public function getOne($id);

	public function create($request);

    public function update($request, $id);

    public function delete($id);

    public function search($request);

    public function selectEmail($request);

}