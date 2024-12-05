<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a paginated list of products.
     *
     * @return \App\Http\Resources\ProductResource
     */
    public function index()
    {
        // Get all products with pagination
        $products = Product::latest()->paginate(5);

        // Return collection of products as a resource
        return new ProductResource(true, 'List of Products', $products);
    }

    /**
     * Store a new product in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\App\Http\Resources\ProductResource
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
        ]);

        // Return response
        return new ProductResource(true, 'Product Successfully Added!', $product);
    }

    /**
     * Display the specified product by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\App\Http\Resources\ProductResource
     */
    public function show($id)
    {
        // Find product by ID
        $product = Product::find($id);

        // Check if product exists
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product Not Found',
            ], 404);
        }

        // Return product as resource
        return new ProductResource(true, 'Product Details', $product);
    }

    /**
     * Update the specified product in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\App\Http\Resources\ProductResource
     */
    public function update(Request $request, $id)
    {
        // Find the product by ID
        $product = Product::find($id);

        // Check if product exists
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product Not Found',
            ], 404);
        }

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update the product
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
        ]);

        // Return updated product
        return new ProductResource(true, 'Product Successfully Updated!', $product);
    }

    /**
     * Delete the specified product from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::find($id);

        // Check if product exists
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product Not Found',
            ], 404);
        }

        // Delete the product
        $product->delete();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Product Successfully Deleted!',
        ]);
    }
}
