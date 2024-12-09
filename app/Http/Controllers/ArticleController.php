<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = auth()->user()->articles;
        return view('pages.index', ['articles' => $articles]);
    }

    public function indexAll(Request $request)
    {
        $categories = Category::all();
        $articlesQuery = Article::with(['comments.user']);
        if ($request->has('category_id') && $request->category_id != '') {
            $articlesQuery->where('category_id', $request->category_id);
        }
        $articles = $articlesQuery->get();
        return view('home', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        return view('pages.create', ['categories' => $categories]);
    }

    public function store(ArticleRequest $request)
    {
        $validateData = $request->validated();

        $validateData['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $validateData['image'] = $imagePath;
        }

        Article::create($validateData);
        return redirect()->route('pages.index')
            ->with('success', 'Sarcina a fost salvată cu succes!');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);

        $this->authorize('view', $article);

        $article = Article::with(['category', 'comments'])->findOrFail($id);
        return view('pages.show', [
            'article' => $article,
        ]);
    }

    public function edit(int $id)
    {
        $article = Article::findOrFail($id);

        $this->authorize('update', $article);

        $categories = Category::all();

        return view('pages.edit', [
            'article' => $article,
            'categories' => $categories,
        ]);
    }

    public function update(ArticleRequest $request, $id)
    {
        $validateData = $request->validated();
        $article = Article::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $this->authorize('update', $article);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $validateData['image'] = $imagePath;
        }
        $article->fill($validateData)->save();
        session()->flash('success', 'Sarcina a fost editată cu succes!');
        return redirect()->route('pages.show', ['page' => $article->id]);
    }

    public function destroy(int $id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('delete', $article);
        $article->delete();

        /** @var \App\Models\User $user */
        $user = auth()->user();

        if ($user && $user->hasRole('admin')) {
            return redirect()->route('home');
        }

        return redirect()->route('pages.index');
    }
}
