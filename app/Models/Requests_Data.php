<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests_Data extends Model
{
    use HasFactory;
    protected $fillable = [
        'country',
        'address',
        'files_path',
        'request_id',
    ];

    public function be_author_request(){
        return $this->belongsTo(Be_Author_Request::class);
    }
}
