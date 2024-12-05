<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a paginated list of orders.
     *
     * @return \App\Http\Resources\OrderResource
     */
    public function index()
    {
        // Get all orders with pagination
        $orders = Order::latest()->paginate(5);

        // Return collection of orders as a resource
        return new OrderResource(true, 'List of Orders', $orders);
    }

    /**
     * Store a new order in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\App\Http\Resources\OrderResource
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'nullable|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create order
        $order = Order::create([
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'total_price' => $request->total_price,
            'status' => $request->status ?? 'pending', // Default status 'pending'
            'category' => $request->category,
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
        ]);

        // Return response
        return new OrderResource(true, 'Order Successfully Created!', $order);
    }

    /**
     * Display the specified order by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\App\Http\Resources\OrderResource
     */
    public function show($id)
    {
        // Find order by ID
        $order = Order::find($id);

        // Check if order exists
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order Not Found',
            ], 404);
        }

        // Return order as resource
        return new OrderResource(true, 'Order Details', $order);
    }

    /**
     * Update the specified order in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\App\Http\Resources\OrderResource
     */
    public function update(Request $request, $id)
    {
        // Find the order by ID
        $order = Order::find($id);

        // Check if order exists
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order Not Found',
            ], 404);
        }

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'nullable|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update the order
        $order->update([
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'total_price' => $request->total_price,
            'status' => $request->status,
            'category' => $request->category,
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
        ]);

        // Return updated order
        return new OrderResource(true, 'Order Successfully Updated!', $order);
    }

    /**
     * Delete the specified order from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find the order by ID
        $order = Order::find($id);

        // Check if order exists
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order Not Found',
            ], 404);
        }

        // Delete the order
        $order->delete();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Order Successfully Deleted!',
        ]);
    }
}
