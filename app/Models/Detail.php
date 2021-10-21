<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail extends Model
{
    protected $fillable= [
        "article_id",
        "slugDetail",
        "type",
        "valeur"
    ];
    use HasFactory;

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
