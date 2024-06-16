<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Author;
use App\Models\RequestsData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = User::with('roles:name')
        ->whereHas('roles', function ($query) {
            $query->where('name','Author');
        })->join('authors', 'users.id', '=', 'authors.user_id')
        ->join('requests_data', 'authors.request_data_id', '=', 'requests_data.id')
        ->select('users.name', 'users.email', 'requests_data.country', 'requests_data.address', 'requests_data.files_path')
        ->get();
        
    return view('authors.show', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = User::whereHas('roles', function ($query) {
            $query->where('name','Author');
        });
        $requests=RequestsData::get();
        return view('authors.create', compact('roles','requests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        
            $user->assignRole('Author');
            // $author_data = RequestsData::create([
            //     'country' => $request->country,
            //     'address' => $request->address,
            //     'path_file' => $request->path_file,
            // ]);
            $author = author::create([
                'user_id' => $user->id,
                'request_data_id' => $request->request_data_id,]);
                return redirect()->route('author.index')->with('success', 'add author has been done');    
    } catch (\Exception $e) {
        return back()->with('error', 'An error occurred while add author.');
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
    }
}
