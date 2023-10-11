<?php 
namespace App\Repositories\Review;

use App\Models\Review;

class ReviewRepository implements ReviewRepositoryInterface
{
    protected $review;
    public function __construct(Review $review)
    {
        $this->review = $review;
    }

	public function getAll()
    {
		return $this->review->orderBy('created_at')->paginate(20);
	}

    public function getOne($id)
    {
        return $this->review->findOrFail($id);
    }

}