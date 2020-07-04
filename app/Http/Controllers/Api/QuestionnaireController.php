<?php

namespace App\Http\Controllers\Api;

use App\Enums\AvailableStatus;
use App\Enums\StatusApi;
use App\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\questionnaire;
use Illuminate\Support\Facades\Validator;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'productId' => 'required',
            'clientId' => 'required',
            'price' => 'required',
            'discount' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=> StatusApi::ErrorInRequest, 'error'=>$validator->errors()], 400);
        }

        try {
            $input = $request->all();
            $product = Product::find($request->input('productId'));
            if($product->available == AvailableStatus::UnAvailable) {
                return response()->json(['status'=> StatusApi::NoAssess, 'error'=>'No Access for Select this Product'], 302);
            }

            $questionnaire = questionnaire::create($input);
            return response()->json(['status' => StatusApi::Created,'message' => 'created', 'data' => $questionnaire], 201);
        }
        catch(\Exception $e){
            return response()->json(['status' => 409,'message' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
