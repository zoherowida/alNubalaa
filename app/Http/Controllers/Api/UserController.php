<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Vali2dator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function index() {
        try {
            $user = User::get();
            return response()->json(['status'=> $this-> successStatus,'message'=>'success', 'data' => $user], $this-> successStatus);

        }
        catch(\Exception $e){
            return response()->json(['status' => 409,'message' => $e], 409);
        }
    }

    /**
     * login api
     *
     * @return JsonResponse
     */
    public function login(){
        if(Auth::attempt(['phoneNumber' => request('phoneNumber'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['role'] =  $user->role_id;
            return response()->json(['status'=> $this-> successStatus,'message'=>'success', 'data' => $success], $this-> successStatus);

        }
        else{
            return response()->json(['status'=> 401, 'error'=>'Unauthorised'], 401);
        }
    }

    /**
     * Register api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phoneNumber' => 'required|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=> 400, 'error'=>$validator->errors()], 400);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['name'] =  $user->name;
        return response()->json(['status'=> $this-> successStatus, 'success'=>$success], $this-> successStatus);
    }
    /**
     * details api
     *
     * @return JsonResponse
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }

}
