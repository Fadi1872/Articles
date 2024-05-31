<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'body',
        'image',
        'category_id',
        'author_id',
       
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function authors(){
        return $this->belongsToMany(Author::class);
    }

    public function favourites(){
        return $this->hasMany(Favourites::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
