<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Movie;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Helpers\v1\ApiResponseV1;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\V1\MovieResourceV1;

class MoviesControllerV1 extends Controller
{
    public function index()
    {
        try {
            $movies = MovieResourceV1::collection(Movie::all());
            return ApiResponseV1::success($movies);
        } catch (\Exception $e) {
            return ApiResponseV1::error($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $movie = Movie::find($id);

            if (!$movie) {
                return ApiResponseV1::error('Movie not found', 404);
            }

            return ApiResponseV1::success(new MovieResourceV1($movie));
        } catch (\Exception $e) {
            return ApiResponseV1::error($e->getMessage(), 500);
        }
    }

    public function store(Request $request){

        try {
            $validator = Validator::make($request->only(['name', 'casts', 'release_date', 'director', 'imdb_rating', 'rotten_tomatoes_rating']), [
                'name' => 'required|string',
                'casts' => 'required|array',
                'release_date' => 'required|date',
                'director' => 'required|string',
                'imdb_rating' => 'required|numeric|min:0|max:10',
                'rotten_tomatoes_rating' => 'required|numeric|min:0|max:10',
            ]);
            
            if ($validator->fails()) {
                return ApiResponseV1::error($validator->errors()->first(), 422);
            }

            $movie = Movie::create([
                'name' => $request->name,
                'casts' => json_encode($request->casts),
                'release_date' => $request->release_date,
                'director' => $request->director,
                'imdb_rating' => $request->imdb_rating,
                'rotten_tomatoes_rating' => $request->rotten_tomatoes_rating,
            ]);

            return ApiResponseV1::success(new MovieResourceV1($movie), 201);
        } catch (\Exception $e) {
            return ApiResponseV1::error($e->getMessage(), 500);
        }    
    }
}

