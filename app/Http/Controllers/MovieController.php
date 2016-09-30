<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Movie;
use Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      $this->getAuthenticatedUser();
      $movies=Movie::all();
      return response()->json($movies);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $this->getAuthenticatedUser();
      $movie =Movie::find($id);
      if(empty($movie))
      {
      return response()->json('Not found',404);
      }
      return response()->json($movie);
    }
    /**
     * Display the specified resource.
     *
     * @param  string  $any
     * @return \Illuminate\Http\Response
     */
    public function search($key)
    {
      $movie= Movie::where('title', '=', $key)->orWhere('year', '=', $key)
       ->orWhere('director', '=', $key)
       ->orWhere('description', 'LIKE', '%'.$key.'%')->first();
       if(empty($movie))
       {
       return response()->json('Not found',404);
       }
       return response()->json($movie);
    }
    public function getAuthenticatedUser()
    {
      try {

          if (! $user = JWTAuth::parseToken()->authenticate()) {
              return response()->json(['user_not_found'], 404);
          }

      } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

          return response()->json(['token_expired'], $e->getStatusCode());

      } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

          return response()->json(['token_invalid'], $e->getStatusCode());

      } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

          return response()->json(['token_absent'], $e->getStatusCode());

        }
      }

}
