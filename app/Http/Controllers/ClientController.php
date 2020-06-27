<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request){

        try {
        $client = Client::with('user')->get();
        return response()->json(['status' => 200,'message' => 'success','data' => $client], 200);

        } catch(\Exception $e){
            return response()->json(['status' => 409,'message' => $e], 409);
        }
    }

    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'subCategory' => 'required',
            'phoneNumber' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'location' => 'required',
            'latLong' => 'required',
         ]);
        try {
            $client = new Client;
            $client->name = $request->input('name');
            $client->subCategory = $request->input('subCategory');
            $client->phoneNumber = $request->input('phoneNumber');
            $client->phone = $request->input('phone');
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
        $this->validate($request, [
            'name' => 'required',
            'subCategory' => 'required',
            'phoneNumber' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'location' => 'required',
            'latLong' => 'required',
         ]);
        try {
            $client = Client::with('user')->find($id);
            $client->name = $request->input('name');
            $client->subCategory = $request->input('subCategory');
            $client->phoneNumber = $request->input('phoneNumber');
            $client->phone = $request->input('phone');
            $client->city = $request->input('city');
            $client->location = $request->input('location');
            $client->latLong = $request->input('latLong');
            $client->AddBy = Auth::id();

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
