<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Be_Author_Requests extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
       
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function request_data(){
        return $this->hasOne(User::class);
    }
}
