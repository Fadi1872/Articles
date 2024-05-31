<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
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
       
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function articles(){
        return $this->belongsToMany(Article::class);
    }
}
