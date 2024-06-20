<?php
namespace App\Http\Controllers\Web;
use App\Models\User;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthorRequest;
use App\Models\RequestsData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {try {
        //create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('Author');
        
        //store the file
        $imageName = time() . '.' . $request->file->getClientOriginalExtension();
        Storage::disk('public')->put('authorDocs/' . $imageName, file_get_contents($request->file));

        //store data request data
        $requestData = RequestsData::create([
            'address' => $request->address,
            'country' => $request->country,
            'files_path' => 'storage/authorDocs/' . $imageName,
        ]);

        Author::create([
            'user_id' => $user->id,
           'request_data_id' => $requestData->id,
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
