<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Author;
use App\Models\RequestsData;
use Illuminate\Http\Request;
use App\Models\BeAuthorRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BeAuthorRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:accept-request', ['only' => ['index']]);
    }

    public function index()
    {
        $requests = BeAuthorRequest::with('user', 'request_data')->where('status', 'pending')->get();
        return view('requests.list', compact('requests'));
    }

    public function indexDone()
    {
        $requests = BeAuthorRequest::with('user', 'request_data')->where('status', '!=', 'pending')->get();
        return view('requests.list', compact('requests'));
    }

    public function show(string $id)
    {
        $request = BeAuthorRequest::where('id', $id)->with('user', 'request_data')->get();

        $request = $request[0];
        
        return view('requests.show', compact('request'));
    }


    public function download_pdf(int $idreq)
    {
        $reqdata = RequestsData::where('be_author_request_id', $idreq)->firstOrFail();

        return Storage::download($reqdata->files_path);

    }
    

    public function reject(BeAuthorRequest $id)
    {
        $id->update([
            'status' => 'rejected'
        ]);
        return redirect()->route('requests.index');
    }

    public function accept(string $id)
    {
        //getting the request
        $request = BeAuthorRequest::where('id', $id)->with('user', 'request_data')->get();
        $request = $request[0];

        //changinf the role of the user
        $user = User::find($request->user->id);
        $user->removeRole('Member');
        $user->assignRole('Author');

        //link the requsts data to the author
        $request_data = RequestsData::find($request->request_data->id);
        $authors = Author::create([
            'user_id' => $user->id,
            'country' => $authors->country,
            'address' => $authors->address,

            'request_data_id' => $request_data->id,
        ]);

        //updating the request status to accepted
        $request->update([
            'status' => 'accepted'
        ]);

        return redirect()->route('requests.index');
    }
}
