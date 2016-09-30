<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use bcrypt;
use App\User ;
use App\Http\Requests;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    // grab credentials from the request
      $credentials = $request->only('email', 'password');

      try {
          // attempt to verify the credentials and create a token for the user
          if (! $token = JWTAuth::attempt($credentials)) {
              return response()->json(['error' => 'invalid_credentials'], 401);
          }
      } catch (JWTException $e) {
          // something went wrong whilst attempting to encode the token
          return response()->json(['error' => 'could_not_create_token'], 500);
      }

      // all good so return the token
      return response()->json(compact('token'));


  }
  public function register(Request $request)
  {
    $user=new User();
    $user->name=$request->name;
    $user->email=$request->email;
    $user->password=Hash::make($request->password);
    $user->save();
    return response()->json('success',200);

  }
}
