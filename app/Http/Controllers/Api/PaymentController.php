<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Get all payments
    public function index()
    {
        $payments = Payment::with(['user', 'order'])->get();
        return response()->json($payments);
    }

    // Create a new payment
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric',
            'status' => 'sometimes|string',
            'payment_method' => 'required|string',
        ]);

        $payment = Payment::create($request->all());
        return response()->json($payment, 201);
    }

    // Get a specific payment
    public function show(Payment $payment)
    {
        return response()->json($payment->load(['user', 'order']));
    }

    // Update a payment
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'order_id' => 'sometimes|exists:orders,id',
            'amount' => 'sometimes|numeric',
            'status' => 'sometimes|string',
            'payment_method' => 'sometimes|string',
        ]);

        $payment->update($request->all());
        return response()->json($payment);
    }

    // Delete a payment
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(null, 204);
    }
}
