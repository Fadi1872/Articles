<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'author_id',
       
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function authors(){
        return $this->belongsToMany(Author::class);
    }
}
