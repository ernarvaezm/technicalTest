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
use Validator;

class AuthController extends Controller
{
/**
* @SWG\Post(
* path="/api/auth/login",
*   tags={"User"},
*   summary="Logs user into the system",
*   description="",
*   operationId="login",
*   produces={ "application/json"},
*   @SWG\Parameter(
*     name="email",
*     in="query",
*     description="The email for login",
*     required=true,
*     type="string"
*   ),
*   @SWG\Parameter(
*     name="password",
*     in="query",
*     description="The password for login in clear text",
*     required=true,
*     type="string"
*   ),
*    @SWG\Response(
*         response=200,
*         description="Token Generated"
*     ),
*   @SWG\Response(
*response=400, description="Invalid credentials")
*   )
*
*/
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
    return response()->json(compact('token'),200);

}
/**
 * Store a newly created resource in storage.
 *
 * @SWG\Post(
 *     path="/api/auth/register",
 *     description="Store a newly created resource in storage.",
 *     operationId="register",
 *     produces={"application/json"},
 *     tags={"User"},
 *   @SWG\Parameter(
 *     name="name",
 *     in="query",
 *     description="The name of new user",
 *     required=true,
 *     type="string"
 *   ),
 *   @SWG\Parameter(
 *     name="password",
 *     in="query",
 *     description="The password for new user in clear text",
 *     required=true,
 *     type="string"
 *   ),
 *   @SWG\Parameter(
 *     name="email",
 *     in="query",
 *     description="The email of new user",
 *     required=true,
 *     type="string"
 *   ),
 *     @SWG\Response(
 *         response=200,
 *         description="User saved."
 *     ),
 *     @SWG\Response(
 *         response=401,
 *         description="Unauthorized action.",
 *    )
 * )
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */


public function register(Request $request)
{
  //validator
  $validator = Validator::make($request->all(), [
          'email' => 'required|unique:users',
          'password' => 'required|max:30',
          'name' => 'required',
      ]);
      if ($validator->fails())
      {
      return response()->json($validator->errors()->all(),422);
      }
      //save the new user
  $user=new User();
  $user->name=$request->name;
  $user->email=$request->email;
  $user->password=Hash::make($request->password);
  $user->save();
  return response()->json('success',200);

}
/**
 * Display the specified resource.
     * @SWG\Get(
      *     path="/api/auth/logout",
      *     description="close session.",
      *     operationId="logout",
      *     produces={"application/json"},
      *     tags={"User"},
      *     @SWG\Response(
      *         response=400,
      *         description="Invalid ID supplied"
      *     )
      * )
 * @return \Illuminate\Http\Response
 */
public function logout()
{
    $this->getAuthenticatedUser();
  JWTAuth::invalidate(JWTAuth::getToken());
  return response()->json('token bloked',200);
}
}
