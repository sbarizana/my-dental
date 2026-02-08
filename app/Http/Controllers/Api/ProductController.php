<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product as ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
        ]);

        $product = ProductModel::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'user_id_created' => auth()->id(),
            'user_id_updated' => auth()->id(),
        ]);

        $product = ProductModel::find($product->id);
        if ($product) {
            return response([
                'message' => 'success',
                'product' => $product,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'product' => 'product does not exist!',
                'status' => 404,
            ]);
        }
    }

    public function getAllProducts()
    {
        $products = ProductModel::all();
        if ($products) {
            return response([
                'message' => 'Success',
                'products' => $products,
            ]);
        } else {
            return response([
                'message' => 'error',
                'products' => 'No products in database',
            ]);
        }
    }

    public function getProduct(Request $request)
    {
        $request->validate(['id' => 'required']);
        $product = ProductModel::find($request->id);
        if ($product) {
            return response([
                'message' => 'success',
                'product' => $product,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'product' => 'Product does not exist',
                'status' => 404,
            ]);
        }
    }

    public function updateProduct(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
        ]);
        $product = ProductModel::find($request->id);
        if ($product) {
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->user_id_updated = auth()->id();
            $product->save();

            return response([
                'message' => 'success',
                'product' => $product,
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'product' => 'Product doesn\'t exist',
                'status' => 404,
            ]);
        }
    }

    public function deleteProduct(Request $request)
    {
        $request->validate(['id' => 'required']);
        $product = ProductModel::find($request->id);
        if ($product) {
            $product->delete();

            return response([
                'message' => 'success',
                'product' => 'Product has been deleted successfully!',
                'status' => 200,
            ]);
        } else {
            return response([
                'message' => 'error',
                'product' => 'Product does not exist!',
                'status' => 404,
            ]);
        }
    }
}
