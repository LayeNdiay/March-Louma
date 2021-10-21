<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Detail;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\PhotoArticle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Cookie;

class AddProductControlleur extends Controller
{
    public function addProduct()
    {
        return view("articles.ajout");
    }


    public function storeProduct( Request $request)
    {
        $request->validate([
            "photo"=>["required","max:2180"],
            "etat"=>["required","max:200","min:2"],
            "nomArticle"=>["required","max:200","min:2"],
            "prix"=>["required","max:200"],
            "categorie"=>["required","max:200"],
            "description"=>["required","min:10"],
            "valeur"=>["required","max:200"],
            "typeProduit"=>["required","max:200"],
        ]);
        $slug = $this->slugify($request->nomArticle ."-". Auth::user()->name);
        $categories = Categorie::create([
            "slugCategorie"=>$this->slugify($request->categorie. time()),
            "nomCategorie"=>$request->categorie,
        ]);
        $article = Article::create([
            "user_id" => Auth::user()->id,
            "categorie_id" => $categories->id,
            "nomArticle"=>$request->nomArticle,
            "etatArticle"=>$request->etat,
            "prixArticle"=>$request->prix,
            "slugArticle"=>$slug,
            "descriptionArticle"=>$request->description,
        ]);
        $photos=[];
        foreach ($request->photo as $key=>$photo) {
                $filename = $slug.'-'.$key.'.'. $photo->extension();
                $path = $photo->storeAs("article",$filename,"public");
                $photos[$key] = PhotoArticle::create([
                    "article_id"=>$article->id,
                    "slugPhotoArticle"=>$this->slugify($filename),
                    "path"=>$path,
                    "isCouverture"=> $key === 0 ? 1 : 0,

                ]);
                
        }
        $details = [];
        foreach ($request->valeur as $key=>$valeur) {
            if ($valeur !== null &&$request->typeProduit[$key] ) {
                $slugDetail = $slug."-details-".$key;
                $details[$key] =Detail::create([
                    "article_id"=>  $article->id,
                    "slugDetail"=> $this->slugify($slugDetail),
                    "type"=> $request->typeProduit[$key],
                    "valeur"=> $valeur,
                ]);
            }
           
            
        }

        return view("articles.viewOneRegestedArticle",[
            "categorie"=>$categories,
            "article"=>$article,
            "photos"=>$photos,
            "details"=>$details
        ]);

        
    }

    public function ViewMyProduct($slugUser,$slugArticle,Response $response,Request $request)
    {
        $slugUser = User::where("slugUser",$slugUser)->first();
        $slugArticle = Article::where("slugArticle",$slugArticle)->first();
        if ($slugArticle &&  $slugUser) {
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
    
    public function editMyProduct($slugUser,$slugArticle) 
    {
        $slugUser = User::where("slugUser",$slugUser)->first();
        $slugArticle = Article::where("slugArticle",$slugArticle)->first();
        if ($slugArticle &&  $slugUser) {
            $article =$slugArticle;
            $photos = [];
            $categorie = $article->categorie()->get()->first(); 
            $details = $article->details()->get();
            $photos = $article->photoArticles()->get();

            return view("articles.editArticle",[
                "categorie"=>$categorie,
                "article"=>$article,
                "photos"=>$photos,
                "details"=>$details
            ]);
        }
        abort(404);
    }
    public function UpdateProduct($slugUser,$slugArticle,Request $request)
    {
        $user = User::where("slugUser",$slugUser)->first();
        $article = Article::where("slugArticle",$slugArticle)->first();
        if ($article &&  $user) 
        {
            $request->validate([
                "photo"=>["max:2180"],
                "etat"=>["required","max:200","min:2"],
                "nomArticle"=>["required","max:200","min:2"],
                "prix"=>["required","max:200"],
                "categorie"=>["required","max:200"],
                "description"=>["required","min:10"],
                "valeur"=>["required","max:200"],
                "typeProduit"=>["required","max:200"],
            ]);
            $photos=[];
            $odlArticle = $article->photoArticles()->get();
            $article->update(
                [
                    "nomArticle"=>$request->nomArticle,
                    "etatArticle"=>$request->etat,
                    "prixArticle"=>$request->prix,
                    "descriptionArticle"=>$request->description,
                ]);
            $categorie = $article->categorie()->get()->first();
            if ($request->photo !==null) 
            {
                foreach ($odlArticle as  $old) {
                    Storage::disk("public")->delete($old->path);
                    $old->delete();
                }
                foreach ($request->photo as $key=>$photo) {
                    $filename = $article->slugArticle.'-Update-'.$key.'.'. $photo->extension();
                    $path = $photo->storeAs("article",$filename,"public");
                    $photos[$key] = PhotoArticle::create([
                        "article_id"=>$article->id,
                        "slugPhotoArticle"=>$this->slugify($filename),
                        "path"=>$path,
                        "isCouverture"=> $key === 0 ? 1 : 0,
    
                    ]); 
                 }
            }
            else {
                $photos = $article->photoArticles()->get();
            }
            $details = [];
            $odlDetails =  $article->details()->get();
           if ($request->valeur !== null ) {
               foreach ($odlDetails as $item) {
                   $item->delete();

               }
                foreach ($request->valeur as $key=>$valeur) {
                    if ( $valeur !== null && $request->typeProduit[$key] ) {
                        $slugDetail = $article->slugArticle."-details-".$key;
                        $details[$key] =Detail::create([
                                "article_id"=>  $article->id,
                                "slugDetail"=> $this->slugify($slugDetail),
                                "type"=> $request->typeProduit[$key],
                                "valeur"=> $valeur,
                        ]);
                    }
                
                    
                }
            }
            return view("articles.viewOneRegestedArticle",[
                "categorie"=>$categorie,
                "article"=>$article,
                "photos"=>$photos,
                "details"=>$details
            ]);
        }
        abort(404);
    }
    public function deleteProduct($slugArticle)
    {
        $article = Article::where("slugArticle",$slugArticle)->first();
        if ($article !==null) {
            $categorie = $article->categorie()->get()->first(); 
            $article->delete();
            $categorie->delete();
            return redirect(RouteServiceProvider::HOME);
        }
        abort(404);
    }
}
