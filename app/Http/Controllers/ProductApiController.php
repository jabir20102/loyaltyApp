<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends Controller
{
    public function index()
    {
        $product = Product::all();

        return response()->json($product);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required',
            'type_id' => 'required',
            'special_code1' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $product = Product::create($request->all());

        return response()->json(['product' => $product, 'message' => 'Product created successfully.'], 201);
    }

    public function read($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        return response()->json($product);
    }

    public function update(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required',
            'type_id' => 'required',
            'special_code1' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $product->update($request->all());

        return response()->json(['product' => $product, 'message' => 'Product updated successfully.']);
    }

    public function delete($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        $product->delete();

        return response()->json(['id' => $productId, 'message' => 'Product deleted successfully.']);
    }
}
