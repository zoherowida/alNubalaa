<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'phoneNumber' => 'required'
        ]);

        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phoneNumber = $request->input('phoneNumber');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            //return successful response
            return response()->json(['status' => 200,'message' => 'created', 'data' => $user], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['status' => 409,'message' => $e], 409);
        }

    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'phoneNumber' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('phoneNumber', $request->input('phoneNumber'))->first();
        if($user == null)
        {
            return response()->json(['status' => 401,'message' => 'fail'], 401);
        }
        if(Hash::check($request->input('password'), $user->password)){
            $apikey = base64_encode(str_random(40));
            User::where('email', $request->input('email'))->update(['api_key' => "$apikey"]);
            return response()->json(['status' => 200,'message' => 'success', 'data' => $apikey], 200);
         } else {
            return response()->json(['status' => 401,'message' => 'fail'], 401);
          }
    }
}
