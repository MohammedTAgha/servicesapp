<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Get all reviews
    public function index()
    {
        $reviews = Review::with(['user', 'service'])->get();
        return response()->json($reviews);
    }

    // Create a new review
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string',
        ]);

        $review = Review::create($request->all());
        return response()->json($review, 201);
    }

    // Get a specific review
    public function show(Review $review)
    {
        return response()->json($review->load(['user', 'service']));
    }

    // Update a review
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'service_id' => 'sometimes|exists:services,id',
            'rating' => 'sometimes|integer|between:1,5',
            'comment' => 'nullable|string',
        ]);

        $review->update($request->all());
        return response()->json($review);
    }

    // Delete a review
    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json(null, 204);
    }
}
