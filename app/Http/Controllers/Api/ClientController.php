<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Client;

class ClientController extends Controller
{
    public function index(Request $request){

        try {
            $client = Client::with('user')->orderBy('id', 'desc')->get();
            return response()->json(['status' => 200,'message' => 'success','data' => $client], 200);

        } catch(\Exception $e){
            return response()->json(['status' => 409,'message' => $e], 409);
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'clientName' => 'required',
            'companyName' => 'required',
            'subCategory' => 'required',
            'phoneNumber' => 'required',
            'latLong' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=> 400, 'error'=>$validator->errors()], 400);
        }

        try {
            $input = $request->all();
            $input['AddBy'] = Auth::user()->id;
            $client = Client::create($input);
            return response()->json(['status' => 200,'message' => 'created', 'data' => $client], 201);
        }
        catch(\Exception $e){

            //return error message
            return response()->json(['status' => 409,'message' => $e], 409);

        }
    }

    public function update($id, Request $request){

        $validator = Validator::make($request->all(), [
            'clientName' => 'required',
            'companyName' => 'required',
            'subCategory' => 'required',
            'phoneNumber' => 'required',
            'latLong' => 'required',
            'location' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> 400, 'error'=>$validator->errors()], 400);
        }

        try {
                $client = Client::find($id)->update(
                [
                    'clientName'=>$request->input('clientName'),
                    'companyName'=>$request->input('companyName'),
                    'subCategory'=>$request->input('subCategory'),
                    'phoneNumber'=>$request->input('phoneNumber'),
                    'phoneCompany'=>$request->input('phoneCompany'),
                    'city'=>$request->input('city'),
                    'location'=>$request->input('location'),
                    'latLong'=>$request->input('latLong'),
                ]);
            return response()->json(['status' => 200,'message' => 'updated', 'data' => $client], 201);
        }
        catch(\Exception $e){

            //return error message
            return response()->json(['status' => 409,'message' => $e], 409);

        }
    }

    public function destroy(Client $id){
        $client = $id->delete();
        return response()->json(['status' => 200, 'message' => 'delete','data' => ''], 200);
    }

}
