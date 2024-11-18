<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Products;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function get(Request $request)
    {
        $product = Products::all();

        return ProductResource::collection($product);
    }

    public function get_by_id(Request $request): ProductResource
    {
        $product = Products::where('id', $request->id)->first();
        if (!$product) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    'message' => 'Product not found'
                ] 
            ], 404));
        }
        return new ProductResource($product);
    }
    
    public function create(CreateProductRequest $request): ProductResource
    {
        $user = Auth::user();
        $merchantid = $user->id;

        $product = new Products($request->validated());
        $product->merchant_id = $merchantid;
        $product->save();
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request): ProductResource
    {
        $user = Auth::user();
        $merchantid = $user->id;

        $product = Products::where('id', $request->id)->where('merchant_id', $merchantid)->first();
        if (!$product) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    'message' => 'Product not found'
                ] 
            ], 404));
        }

        $data = $request->validated();
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->save();
        
        return new ProductResource($product);
    }

    public function delete(Request $request): JsonResponse
    {
        $user = Auth::user();
        $merchantid = $user->id;

        $product = Products::where('id', $request->id)->where('merchant_id', $merchantid)->first();
        if (!$product) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    'message' => 'Product not found'
                ] 
            ], 404));
        }
        $product->delete();
        return response()->json([
            "message" => "Product deleted"
        ]);
    }
}
