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
   * @SWG\Get(
   *     path="/api/movies/",
   *     summary="Display a listing of all movies.",
   *     tags={"Movie"},
   *     description="Get all movies",
   *     operationId="index",
   *     consumes={ "application/json"},
   *     produces={"application/json"},
   *     @SWG\Response(
   *         response=200,
   *         description="successful operation"
   *     ),
   *     @SWG\Response(
   *         response="401",
   *         description="Unauthorized action.",
   *     ),
   *     @SWG\Response(
   *         response=200,
   *         description="Operation successful."
   *    )
   * )
   *
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
         * @SWG\Get(
          *     path="/api/movies/{movie_id}",
          *     description="Display the specified movie.",
          *     operationId="show",
          *     produces={"application/json"},
          *     tags={"Movie"},
          *   @SWG\Parameter(
          *     name="movie_id",
          *     in="path",
          *     description="id movie that you want see",
          *     required=true,
          *     type="integer"
          *   ),
          *     @SWG\Response(
          *         response=401,
          *         description="Unauthorized action."
          *    ),
          *     @SWG\Response(
          *         response=404,
          *         description="Movie not found.",
          *    ),
          *     @SWG\Response(
          *         response=200,
          *         description="Operation successful."
          *    )
          * )
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($movie_id)
    {
      $this->getAuthenticatedUser();
      $movie =Movie::find($movie_id);
      if(empty($movie))
      {
      return response()->json('Not found',404);
      }
      return response()->json($movie);
    }
    /**
     * Display the specified resource.
         * @SWG\Get(
          *     path="/api/movies/search/{text}",
          *     description="Display the specified movie.",
          *     operationId="search",
          *     produces={"application/json"},
          *     tags={"Movie"},
          *   @SWG\Parameter(
          *     name="text",
          *     in="path",
          *     description="any value that you want search ",
          *     required=true,
          *     type="string"
          *   ),
          *     @SWG\Response(
          *         response=401,
          *         description="Unauthorized action."
          *    ),
          *     @SWG\Response(
          *         response=200,
          *         description="Operation successful."
          *    ),
          *     @SWG\Response(
          *         response=404,
          *         description="Movie not found.",
          *    )
          * )
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($key)
    {
        $this->getAuthenticatedUser();
      $movie= Movie::where('title', '=', $key)->orWhere('year', '=', $key)
       ->orWhere('director', '=', $key)
       ->orWhere('description', 'LIKE', '%'.$key.'%')->first();
       if(empty($movie))
       {
       return response()->json('Not found',404);
       }
       return response()->json($movie);
    }
  



}
