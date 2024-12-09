@extends('layout.app')

@section('title', 'Create Category')

@section('content')
@if (session()->has('success'))
    <div class="alert alert-success text-red-500 text-center py-3 px-6 rounded-md mt-4">
        {{ session('success') }}
    </div>
@endif

    <div class="max-w-md mx-auto mt-10 p-5">
        <h1 class="text-2xl font-bold mb-5 text-center">Adaugă o categorie</h1>
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Titlu:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-cyan-500">
            </div>
            @error('name')
                <div class="text-red-500">*{{ $message }}</div>
            @enderror

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descriere (opțional):</label>
                <textarea id="description" name="description"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-cyan-500"
                    rows="3">{{ old('description') }}</textarea>
            </div>
            @error('description')
                <div class="text-red-500">*{{ $message }}</div>
            @enderror

            <div>
                <button type="submit"
                    class="w-full bg-cyan-600 text-white font-semibold py-2 rounded-md hover:bg-cyan-700 focus:outline-none">Salvează
                    Categoria</button>
            </div>
        </form>
    </div>
@endsection
