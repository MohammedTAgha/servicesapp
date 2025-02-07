<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Get all orders
    public function index()
    {
        $orders = Order::with(['user', 'service'])->get();
        return response()->json($orders);
    }

    // Create a new order
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'sometimes|string',
            'payment' => 'required|numeric',
            'date' => 'required|date',
            'location' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $order = Order::create($request->all());
        return response()->json($order, 201);
    }

    // Get a specific order
    public function show(Order $order)
    {
        return response()->json($order->load(['user', 'service']));
    }

    // Update an order
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'service_id' => 'sometimes|exists:services,id',
            'user_id' => 'sometimes|exists:users,id',
            'status' => 'sometimes|string',
            'payment' => 'sometimes|numeric',
            'date' => 'sometimes|date',
            'location' => 'sometimes|string',
            'notes' => 'nullable|string',
        ]);

        $order->update($request->all());
        return response()->json($order);
    }

    // Delete an order
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }
}
