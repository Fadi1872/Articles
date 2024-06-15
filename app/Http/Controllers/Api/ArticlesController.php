<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:show-articles', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-article', ['only' => ['store', 'show']]);
        $this->middleware('permission:edit-own-article', ['only' => ['update', 'show']]);
        $this->middleware('permission:delete-own-article', ['only' => ['delete', 'show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // this will be edited later when we add block authors
        $articles = Article::all();
        return ArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        //store the image in the public folder
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        Storage::disk('public')->put('images', $imageName, file_get_contents($request->image));

        //store in database
        Article::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $imageName,
            'category_id' => $request->category_id
        ]);

        return response()->json(['message' => 'article posted successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::where('id', $id)->with('category')->get();
        return new ArticleResource($article[0]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreArticleRequest $request, Article $article)
    {
        $updatedData = [
            'title' => $request->title,
            'body' => $request->body,
            'category' => $request->category
        ];

        if (isset($request->image)) {
            if (Storage::disk('public')->exists('images/' . $article->image)) {
                Storage::disk('public')->delete('images/' . $article->image);
            }

            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            Storage::disk('public')->put('images', $imageName, file_get_contents($request->image));

            $updatedData['image'] = $imageName;
        }
        $article->update($updatedData);

        return response()->json(['message' => 'article updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        if (Storage::disk('public')->exists('images/' . $article->image)) {
            Storage::disk('public')->delete('images/' . $article->image);
        }

        return response()->json(['message' => 'article deleted successfully!']);
    }
}
