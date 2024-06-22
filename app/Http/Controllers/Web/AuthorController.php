<?php
namespace App\Http\Controllers\Web;
use App\Models\User;
use App\Models\Author;
use app\Models\RequestsData;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  $authors = Author::with('userData', 'requestData')->get();

    // return $authors;
    return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $roles = Role::get();

        return view('authors.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('Author');
        $authors = Author::create([
            'user_id' => $user->id,
            'country' => $authors->country,
            'address' => $authors->address,
           'request_data_id' => $request->request_data_id,
        ]);
       return redirect()->route('authors.index');
    } catch (\Exception $e) {
        return back()->with('error', ' created Author has been faild');
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
