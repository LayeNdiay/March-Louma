<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhotoArticle extends Model
{
    protected $fillable = [
        "article_id",
        "slugPhotoArticle",
        "path",
        "isCouverture",
    ];
    use HasFactory;
    public function Article()
    {
        return $this->belongsTo(Article::class);
    }
}
