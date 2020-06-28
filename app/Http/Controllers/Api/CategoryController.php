<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
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

}
