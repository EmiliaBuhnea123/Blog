<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index()
    {
        if (Gate::denies('view-all-profiles')) {
            abort(403, 'Nu aveți acces la această pagină.');
        }

        $profiles = Profile::all();
        return view('admin.index', compact('profiles'));
    }

    public function create(Request $request)
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Category::create($validated);

        return redirect()->route('admin.create')->with('success', 'Categoria a fost adăugată cu succes!');
    }
}
