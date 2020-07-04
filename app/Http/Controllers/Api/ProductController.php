<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Enums\AvailableStatus;
use App\Enums\StatusApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request){
        try {
            $product = Product::with('category')->orderBy('id', 'desc')->get();
            return response()->json(['status' => StatusApi::Selected,'message' => 'success','data' => $product], 200);
        } catch(\Exception $e){
            //return error message
            return response()->json(['status' => StatusApi::Exception,'message' => $e], 409);
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
            return response()->json(['status'=> StatusApi::ErrorInRequest, 'error'=>$validator->errors()], 400);
        }

        try {
            $category = Category::find($request->input('categoryId'));
            if($category->available == AvailableStatus::UnAvailable) {
                return response()->json(['status'=> StatusApi::NoAssess, 'error'=>'No Access for Select this Category'], 302);
            }

            $product = new Product;
            $product->name = $request->input('name');
            $product->categoryId = $request->input('categoryId');
            $product->wholesalePrice = $request->input('wholesalePrice');
            $product->sellingPrice = $request->input('sellingPrice');
            $product->subCategory = $request->input('subCategory');

            $product->save();

            //return successful response
            return response()->json(['status' => StatusApi::Created,'message' => 'created', 'data' => $product], 201);
        }
        catch(\Exception $e){

            //return error message
            return response()->json(['status' => StatusApi::Exception,'message' => $e], 409);

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
            return response()->json(['status'=> StatusApi::ErrorInRequest, 'error'=>$validator->errors()], 400);
        }

        try {
            $product = Product::with('category')->find($id);
            $category = Category::find($request->input('categoryId'));
            if($category->status == AvailableStatus::UnAvailable) {
                return response()->json(['status'=> StatusApi::NoAssess, 'error'=>'No Access for Select this Category'], 302);
            }

            $product->name = $request->input('name');
            $product->categoryId = $request->input('categoryId');
            $product->wholesalePrice = $request->input('wholesalePrice');
            $product->sellingPrice = $request->input('sellingPrice');
            $product->subCategory = $request->input('subCategory');

            $product->save();

            //return successful response
            return response()->json(['status' => StatusApi::Updated,'message' => 'updated', 'data' => $product], 201);
        }
        catch(\Exception $e){

            //return error message
            return response()->json(['status' => StatusApi::Exception,'message' => $e], 409);

        }
    }

    public function destroy($id){
        try {
            $product = Product::find($id)->delete();
            return response()->json(['status' => StatusApi::Deleted, 'message' => 'delete','data' => ''], 200);

        }
        catch (\Exception $e){
            return response()->json(['status' => StatusApi::Exception,'message' => $e], 409);
        }
    }
    public function status($id){
        try {
            $product = Product::with('category')->find($id);
            $status = 0;
            $product->status === 1 ? $status = 2 : $status = 1 ;
            $product->status = $status;
            $product->save();
            return response()->json(['status' => StatusApi::ChangeStatus,'message' => 'success','data' => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => StatusApi::Exception,'message' => $e], 409);

        }
    }

}
