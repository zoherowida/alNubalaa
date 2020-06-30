<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request){
        try {
            $product = Product::with('category')->orderBy('id', 'desc')->get();
            return response()->json(['status' => 200,'message' => 'success','data' => $product], 200);
        } catch(\Exception $e){
            //return error message
            return response()->json(['status' => 409,'message' => $e], 409);
        }
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'categoryId' => 'required|exists:categories,id',
            'wholesalePrice' => 'required',
            'sellingPrice' => 'required',
            'subCategory' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=> 400, 'error'=>$validator->errors()], 400);
        }

        try {
            $product = new Product;
            $product->name = $request->input('name');
            $product->categoryId = $request->input('categoryId');
            $product->wholesalePrice = $request->input('wholesalePrice');
            $product->sellingPrice = $request->input('sellingPrice');
            $product->subCategory = $request->input('subCategory');

            $product->save();

            //return successful response
            return response()->json(['status' => 200,'message' => 'created', 'data' => $product], 201);
        }
        catch(\Exception $e){

            //return error message
            return response()->json(['status' => 409,'message' => $e], 409);

        }
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'categoryId' => 'required|exists:categories,id',
            'sellingPrice' => 'required',
            'wholesalePrice' => 'required',
            'subCategory' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=> 400, 'error'=>$validator->errors()], 400);
        }

        try {
            $product = Product::with('category')->find($id);
            $product->name = $request->input('name');
            $product->categoryId = $request->input('categoryId');
            $product->wholesalePrice = $request->input('wholesalePrice');
            $product->sellingPrice = $request->input('sellingPrice');
            $product->subCategory = $request->input('subCategory');

            $product->save();

            //return successful response
            return response()->json(['status' => 200,'message' => 'updated', 'data' => $product], 201);
        }
        catch(\Exception $e){

            //return error message
            return response()->json(['status' => 409,'message' => $e], 409);

        }
    }

    public function destroy(Product $id){
        $product = $id->delete();
        return response()->json(['status' => 200, 'message' => 'delete','data' => ''], 200);
    }

}
