<?php 
namespace App\Repositories\Review;

interface ReviewRepositoryInterface{
	
	public function getAll();

    public function getOne($id);

}