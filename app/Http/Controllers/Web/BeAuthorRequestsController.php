<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Be_Author_Request;
use Illuminate\Http\Request;

class BeAuthorRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:accept-request', ['only' => ['index']]);
    }

    public function index()
    {
        $requests = Be_Author_Request::with('request_data');
    }
}
