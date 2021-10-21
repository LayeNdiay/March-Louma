<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $articles = $user->articles()->orderBy("created_At",'DESC')->get();
        $categories = [];
        $photos = [];
        $path = [];
        foreach ($articles as $key=> $article) {
            $categories[$key] = $article->categorie()->get();
            $details[$key] = $article->details()->get();
            $photos[$key] = $article->photoArticles()->get();
            $path[$key] = $photos[$key]->where('isCouverture', 1);
        }
        $vide = false;
        if (empty($path)) {
            $vide = true;
        }
        return view('dashboard',[
            "articles"=>$articles,
            "categorie"=>$categories,
            "path"=>$path,
            "vide"=>$vide
        ]);
    }

   
}
