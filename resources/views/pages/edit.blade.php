@extends('layout.app')

@section('title', 'Edit Article')

@section('content')
    <div class="max-w-md mx-auto mt-10 p-5">
        <h1 class="text-2xl font-bold mb-5">Editează articolul</h1>
        <form action="{{ route('pages.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Titlu:</label>
                <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-cyan-500">
            </div>
            @error('title')
                <div class="text-red-500">*{{ $message }}</div>
            @enderror

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descriere:</label>
                <textarea id="description" name="description"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-cyan-500"
                    rows="4">{{ old('description', $article->description) }}</textarea>
            </div>
            @error('description')
                <div class="text-red-500">*{{ $message }}</div>
            @enderror

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Categorie:</label>
                <select id="category_id" name="category_id"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-cyan-500">
                    <option value="" disabled selected>Alege o categorie</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if (old('category_id', $article->category_id) == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
                </select>
            </div>
            @error('category_id')
                <div class="text-red-500">*{{ $message }}</div>
            @enderror

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Imagine:</label>
                @if ($article->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="Image" class="w-full h-auto rounded-md">
                    </div>
                @endif
                <input type="file" id="image" name="image"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-cyan-500">
            </div>
            
            @error('image')
                <div class="text-red-500">*{{ $message }}</div>
            @enderror

            <div>
                <button type="submit"
                    class="w-full bg-cyan-600 text-white font-semibold py-2 rounded-md hover:bg-cyan-700 focus:outline-none">Editează
                    articolul</button>
            </div>
        </form>
    </div>
@endsection
