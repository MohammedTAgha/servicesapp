<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Get all categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Create a new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    // Get a specific category
    public function show(Category $category)
    {
        return response()->json($category);
    }

    // Update a category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'sometimes|string',
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());
        return response()->json($category);
    }

    // Delete a category
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
