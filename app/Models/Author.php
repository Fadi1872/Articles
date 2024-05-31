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
        'country',
        'address',
        'files_path',
        'user_id',
    ];

    public function articles(){
        return $this->belongsToMany(Article::class);
    }

    public function userData(){
        return $this->belongsTo(User::class);
    }
    
    public function blocks(){
        return $this->belongsToMany(User::class, 'blocks');
    }
}
