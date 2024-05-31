<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country',
        'address',
        'files_path',
        'user_id',
       
    ];

    public function articles(){
        return $this->belongsToMany(Article::class);
    }
    
    public function blocks(){
        return $this->hasMany(Block::class);
    }
   
}
