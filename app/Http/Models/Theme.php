<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Article;

class Theme extends Model
{
    protected $table = 'themes';
    protected $guarded = [''];

    public function noticias()
    {
      return $this->belongsTo(Article::class);

    }
}
