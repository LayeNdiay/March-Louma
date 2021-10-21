<?php

namespace App\Models;

use App\Models\User;
use App\Models\Detail;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravelista\Comments\Commentable;

class Article extends Model
{
    use HasFactory,Commentable;
    protected $fillable = [
        "user_id", 
        "categorie_id", 
        "slugArticle",
        "nomArticle",
        "etatArticle",
        "prixArticle",
        "descriptionArticle"
    ];
    /**
     * Get all of the details for the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details(): HasMany
    {
        return $this->hasMany(Detail::class);
    }

    /**
     * Get all of the photoArticle for the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photoArticles(): HasMany
    {
        return $this->hasMany(PhotoArticle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    
}
