<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'user_id',
        'article_id',
        'body',
       
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function articles(){
        return $this->belongsToMany(Article::class);
    }
}
