@extends('layout.auth')

@section('content')
<h1 class="text-3xl font-bold text-center">Create Profile</h1>

<form method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm" required>
        @error('name')
            <p class="text-red-500">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="description" id="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm" rows="4"></textarea>
        @error('description')
            <p class="text-red-500">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="mb-4">
        <label for="avatar" class="block text-sm font-medium text-gray-700">Avatar</label>
        <input type="file" name="avatar" id="avatar" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
        @error('avatar')
            <p class="text-red-500">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="mb-4">
        <button type="submit" class="w-full px-3 py-2 text-white bg-cyan-600 rounded-md hover:bg-cyan-700 focus:outline-none focus:bg-cyan-700">Create Profile</button>
    </div>
</form>
@endsection
