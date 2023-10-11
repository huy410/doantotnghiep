<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\NotificationAdmin;
use App\Repositories\Review\ReviewRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    protected $reviewRepositoryInterface;
    public function __construct(ReviewRepositoryInterface $reviewRepositoryInterface)
    {
        $this->reviewRepositoryInterface = $reviewRepositoryInterface;
    }

    public function index()
    {
        $reviews = $this->reviewRepositoryInterface->getAll();
        return view('admin.reviews.reviewsView', ['reviews' => $reviews]);
    }

    public function show($id)
    {
        $review =  $this->reviewRepositoryInterface->getOne($id);
        return view('admin.reviews.reviewsDetailView', ['review' => $review]);
    }
}
