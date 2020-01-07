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
                ->select('movies.*')->orderBy('release', 'ASC')
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
                ->select('movies.*')->orderBy('rating', 'DESC')
                ->paginate(10);
        return response($movies)
        ->header('Content-Type', 'application/json');
    }

    public function latests() {        
        $movies = \App\Movie::where('language_id', \App\Language::LANG_EN)
                ->select('movies.*')
                ->orderBy('created_at', 'DESC')
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

    public function getStreamLink(Request $request) {
        $link = $this->stream($request->slug);
        return response($link)
            ->header('Content-Type', 'application/json');
    }

    protected function req($url, $post=null){
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url);
            if($post != null){
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $headers = array();
        $headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 5.0; SM-G900P Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.119 Mobile Safari/537.36';
        $headers[] = 'X-Requested-With: XMLHttpRequest';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        return curl_exec($ch);
    }

    protected function stream($n){
        $links = array();
        $f = $this->req("https://d21.tv/ajax/movie.php", "slug=".$n);
        preg_match_all('/<a href="(.*?)" target="iframe" class="(.*?)">/', $f, $d);
        foreach ($d[1] as $key => $value) {
            $links[] = array('link' => $value);
        } 
        return array("stream" => $links);
    }

}
