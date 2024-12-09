@extends('layout.app')

@section('title', 'Detalii articol')

@section('content')
<div class="container max-w-6xl mx-auto my-5 p-5 bg-slate rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-5 ">{{ $article->title }}</h1>

        <div class="mb-5">
            <p class="text-gray-800">{{ $article->description }}</p>
        </div>

        <div class="mb-5">
            <h2 class="text-lg font-semibold text-gray-700">Categorie:</h2>
            <p class="text-gray-800">{{ $article->category->name }}</p>
        </div>

        @if ($article->image)
            <div class="mb-5">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                    class="w-full h-auto rounded-md">
            </div>
        @endif

        <div class="flex flex-row gap-3">
        <a href="{{ route('pages.edit', $article->id) }}" class=" bg-cyan-400 p-3 rounded-md">Edit</a>

        <form action="{{ route('pages.destroy', $article->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class=" bg-amber-400 p-3 rounded-md">Delete</button>
        </form>
        </div>
    </div>
@endsection
