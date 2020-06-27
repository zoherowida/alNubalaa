<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request){

        try {
        $category = Category::get();
        return response()->json(['status' => 200,'message' => 'success','data' => $category], 200);

        } catch(\Exception $e){
            return response()->json(['status' => 409,'message' => $e], 409);
        }
    }

    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required|string',
         ]);
        try {
            $category = new Category;
            $category->name = $request->input('name');
            $category->subCategory = $request->input('subCategory');

            $category->save();

            //return successful response
            return response()->json(['status' => 200,'message' => 'updated', 'data' => $category], 201);
        }
        catch(\Exception $e){

            //return error message
            return response()->json(['status' => 409,'message' => $e], 409);

        }
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'name' => 'required|string',
         ]);
        try {
            $category = Product::find($id);
            $category->name = $request->input('name');
            $category->subCategory = $request->input('subCategory');

            $category->save();

            //return successful response
            return response()->json(['status' => 200,'message' => 'updated', 'data' => $category], 201);
        }
        catch(\Exception $e){

            //return error message
            return response()->json(['status' => 409,'message' => $e], 409);

        }
    }

    public function destroy($id){
        $category = Category::get();
        return response()->json(['message' => 'success','category' => $category], 200);
        return $category;
    }

}
