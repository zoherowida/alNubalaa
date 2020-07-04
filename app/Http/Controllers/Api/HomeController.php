<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Enums\StatusApi;
use App\Product;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function statistics(){

        try {
            $client = Client::get()->count();
            $product = Product::get()->count();
            $category = Category::get()->count();

            $countArray = [
                'statistics' => []
            ];
            $countArray['statistics'][] = ['label'=>'العملاء', 'count'=>$client];
            $countArray['statistics'][] = ['label'=>'المنتجات', 'count'=>$product];
            $countArray['statistics'][] = ['label'=>'التصنيفات', 'count'=>$category];
            return response()->json(['status'=> StatusApi::Selected,'message'=>'success', 'data' => $countArray], 200);



        }catch (\Exception $e) {
            return response()->json(['status' => StatusApi::Exception,'message' => $e], 409);
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
