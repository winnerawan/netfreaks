<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Medoo;
use DB;
use Goutte;
use Response;
// use Symfony\Component\DomCrawler\Crawler;

class ApiController extends Controller
{

    public function languages() {
        return response(\App\Language::all())
        ->header('Content-Type', 'application/json');
    }

    public function news() {
        $movies = \App\Movie::where('language_id', \App\Language::LANG_EN)
                ->select('movies.*')->orderBy('release', 'DESC')
                ->paginate(10);
        return response($movies)
        ->header('Content-Type', 'application/json');
    }

    public function genres() {
        return response(\App\Genre::all())
        ->header('Content-Type', 'application/json');
    }

    public function genre(Request $request) {
        $genre = $request->input('genre');
        $movies = \App\Movie::where('genres','LIKE',"%{$genre}%")
            ->where('language_id', \App\Language::LANG_EN)
            ->orderBy('title', 'ASC')->paginate(10);
        return response($movies)
        ->header('Content-Type', 'application/json');
    }

    public function search(Request $request) {
        $keyword = $request->input('keyword');
        $movies = \App\Movie::where('title','LIKE',"%{$keyword}%")     
            ->where('language_id', \App\Language::LANG_EN)       
            ->orderBy('title', 'ASC')->paginate(10);
        return response($movies)
        ->header('Content-Type', 'application/json');
    }

    public function populars() {
        $movies = \App\Movie::where('language_id', \App\Language::LANG_EN)
                ->whereRaw("rating REGEXP '^-?[0-9]+$'")
                ->select('movies.*')
                ->paginate(10);
        return response($movies)
        ->header('Content-Type', 'application/json');
    }

    public function latests() {        
        $movies = \App\Movie::where('language_id', \App\Language::LANG_EN)
                ->select('movies.*')
                ->orderByRaw("RAND()")
                ->paginate(10);
        return response($movies)
        ->header('Content-Type', 'application/json');
    }

    public function movies() {
        $movies = \App\Movie::where('language_id', \App\Language::LANG_EN)->paginate(10);
        return response($movies)
        ->header('Content-Type', 'application/json');
    }

    public function ads() {
        $ads = \App\Ad::all();
        return response($ads)
        ->header('Content-Type', 'application/json');
    }

}
