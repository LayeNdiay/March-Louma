<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;

class InviteControlleur extends Controller
{
    public function ViewCategorie($nomCategorie)
    {
        $mesCtegories = ["vehicule","immobilier","maison","electronique","vetement","chaussure","mode","animaux","agroalimentaire","autres","fournitures"];
        if (in_array($nomCategorie,$mesCtegories) ) 
        {
            $categories = Categorie::  where("nomCategorie",$nomCategorie)->get();

            $articles=[];
            
            foreach ($categories as $key=>$categorie) 
            {
                
                $articles[$key] = $categorie->articles()->orderBy("created_at","DESC")->get()->first();
    
            }
            $categories = [];
            $photos = [];
            $path = [];
            $vide = empty($articles) ? true : false;
            foreach ($articles as $key=> $article) {
               if ($article !== null) {
                $categories[$key] = $article->categorie()->get();
                $details[$key] = $article->details()->get();
                $photos[$key] = $article->photoArticles()->get();
                $path[$key] = $photos[$key]->where('isCouverture', 1);
               }
               else {
                   $vide =  true;
               }
            }
            
            return view('articles.viewArticles',[
                "articles"=>$articles,
                "categorie"=>$categories,
                "path"=>$path,
                "vide"=>$vide,
                "active"=>$nomCategorie,
                "visite"=>false
            ]);
        }
        abort(404);
        
    }

    public function espaceVendeur($slugVendeur)
    {
        $user = User::where("slugUser",$slugVendeur)->first();
        if ($user ) {

            $articles= $user->articles()->get();
            $categories = [];
            $photos = [];
            $path = [];
            foreach ($articles as $key=> $article) {
                $categories[$key] = $article->categorie()->get();
                $details[$key] = $article->details()->get();
                $photos[$key] = $article->photoArticles()->get();
                $path[$key] = $photos[$key]->where('isCouverture', 1);
            }
            $visite = null;
            if (!$visite) {
                $visite = $articles[0]->user()->get()->first();
            }
                
            $vide = empty($articles) ? true : false;
            return view('articles.viewArticles',[
                "articles"=>$articles,
                "categorie"=>$categories,
                "path"=>$path,
                "vide"=>$vide,
                "active"=>"null",
                "visite"=>$visite
            ]);
           
        }
        abort(404);
    }
    public function allArticles()
    {
        return Article::all();
    }
    public function viewArticle($slugArticle)
    {
        $slugArticle = Article::where("slugArticle",$slugArticle)->first();
        if ($slugArticle ) {
            $article =$slugArticle;
            $photos = [];
            $categorie = $article->categorie()->get()->first(); 
            $details = $article->details()->get();
            $photos = $article->photoArticles()->get();
            if (!isset($_COOKIE[$article->slugArticle])) {
                setcookie($article->slugArticle,true);
                $article->nbreVue ++;
                $article->save();
            }
            $created = new DateTime($article->created_at);
            $now = new DateTime(now());
            $diff = $now->diff($created);
            $durre = null;

            if ($diff->y !== 0) {
               $durre = $diff->y > 1 ? $diff->y . 'années' : $diff->y . 'année' ;
            }
            elseif ($diff->m !==0) {
                $durre = $diff->m > 1 .'mois';
            }
            elseif ($diff->d !==0) {
                $durre = $diff->d > 1 ? $diff->d . 'jours' : $diff->d . 'jour' ;
            }
            elseif ($diff->h !==0) {
                $durre = $diff->h > 1 ? $diff->h . 'heure' : $diff->h . 'heures' ;
            }
            elseif ($diff->i !==0) {
                $durre = $diff->i > 1 ? $diff->i . 'jours' : $diff->i . 'jour' ;
            }
            else
            {
                $durre = "quelques secondes";
            }
            return view("articles.viewOneArticle",[
                "categorie"=>$categorie,
                "article"=>$article,
                "photos"=>$photos,
                "details"=>$details,
                "durree"=>$durre
            ]);
        }
        abort(404);
    }
    public function  rechercher($query, Request $request)
    {
        $articles = Article::where('nomArticle', $query )
                            ->orWhere("nomArticle", 'like' , '%'. $query ."%")
                            ->get();
        $categories = [];
            $photos = [];
            $path = [];
            foreach ($articles as $key=> $article) {
               if ($article !== null) {
                $categories[$key] = $article->categorie()->get();
                $details[$key] = $article->details()->get();
                $photos[$key] = $article->photoArticles()->get();
                $path[$key] = $photos[$key]->where('isCouverture', 1);
               }
            }
            
            return view('articles.viewArticles',[
                "articles"=>$articles,
                "categorie"=>$categories,
                "path"=>$path,
                "vide"=>false,
                "active"=>"search",
                "visite"=>false
            ]);
    }
}
