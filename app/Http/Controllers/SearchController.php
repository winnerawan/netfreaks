<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Genre;
use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{

    public function searchMovie(Request $request) {
        if ($request->has('q')) {
            $data = Movie::select("id", "title")->where("title", "LIKE", "%{$request->q}%")->get();
            return response()->json($data);
        }
    }
}
