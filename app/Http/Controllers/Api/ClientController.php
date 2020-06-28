<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Client;
class ClientController extends Controller
{
        public function index(Request $request){

            try {
            $client = Client::with('user')->get();
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
                'city' => 'required',
                'location' => 'required',
                'latLong' => 'required',
             ]);
                          if ($validator->fails()) {
                          return response()->json(['status'=> 401, 'error'=>$validator->errors()], 401);
                          }

            try {
                $client = new Client;
                $client->clientName = $request->input('clientName');
                $client->companyName = $request->input('companyName');
                $client->subCategory = $request->input('subCategory');
                $client->phoneNumber = $request->input('phoneNumber');
                $client->phoneCompany = $request->input('phoneCompany');
                $client->city = $request->input('city');
                $client->location = $request->input('location');
                $client->latLong = $request->input('latLong');
                $client->AddBy = Auth::id();

                $client->save();

                //return successful response
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
                'city' => 'required',
                'location' => 'required',
                'latLong' => 'required',
             ]);
                          if ($validator->fails()) {
                          return response()->json(['status'=> 401, 'error'=>$validator->errors()], 401);
                          }

            try {
                $client->clientName = $request->input('clientName');
                $client->companyName = $request->input('companyName');
                $client->subCategory = $request->input('subCategory');
                $client->phoneNumber = $request->input('phoneNumber');
                $client->phoneCompany = $request->input('phoneCompany');
                $client->city = $request->input('city');
                $client->location = $request->input('location');
                $client->latLong = $request->input('latLong');

                $client->save();

                //return successful response
                return response()->json(['status' => 200,'message' => 'updated', 'data' => $client], 201);
            }
            catch(\Exception $e){

                //return error message
                return response()->json(['status' => 409,'message' => $e], 409);

            }
        }

        public function destroy($id){
            $category = Category::get();
            return response()->json(['status' => 200,'message' => 'success','data' => $category], 200);
            return $category;
        }

}
