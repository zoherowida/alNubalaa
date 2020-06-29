<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request){

        try {
        $category = Category::get();
        return response()->json(['status' => 200,'message' => 'success','data' => $category], 200);

        } catch(\Exception $e){
            return response()->json(['status' => 409,'message' => $e], 409);
        }
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
         ]);
             if ($validator->fails()) {
             return response()->json(['status'=> 401, 'error'=>$validator->errors()], 401);
             }

        try {
            $category = new Category;
            $category->name = $request->input('name');

            $category->save();

            //return successful response
            return response()->json(['status' => 200,'message' => 'create', 'data' => $category], 201);
        }
        catch(\Exception $e){

            //return error message
            return response()->json(['status' => 409,'message' => $e], 409);

        }
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
         ]);
                      if ($validator->fails()) {
                      return response()->json(['status'=> 401, 'error'=>$validator->errors()], 401);
                      }

        try {
            $category = Category::find($id);
            $category->name = $request->input('name');

            $category->save();

            //return successful response
            return response()->json(['status' => 200,'message' => 'update', 'data' => $category], 201);
        }
        catch(\Exception $e){

            //return error message
            return response()->json(['status' => 409,'message' => $e], 409);

        }
    }

    public function destroy(Categoy $id){
        $category = $id->delete();
        return response()->json(['status' => 200, 'message' => 'delete','data' => ''], 200);
    }


}
