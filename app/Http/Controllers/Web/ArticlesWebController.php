<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('category')->get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        //store the image in the public folder
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        Storage::disk('public')->put('images/' . $imageName, file_get_contents($request->file('image')));

        //store in database
        Article::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $imageName,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $updatedData = [
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ];

        if (isset($request->image)) {
            if (Storage::disk('public')->exists('images/' . $article->image)) {
                Storage::disk('public')->delete('images/' . $article->image);
            }

            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            Storage::disk('public')->put('images/' . $imageName, file_get_contents($request->image));

            $updatedData['image'] = $imageName;
        }

        $article->update($updatedData);
        return redirect()->route('articles.show', $article->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if (Storage::disk('public')->exists('images/' . $article->image)) {
            Storage::disk('public')->delete('images/' . $article->image);
        }
        $article->delete();

        return redirect()->route('articles.index');
    }
}
