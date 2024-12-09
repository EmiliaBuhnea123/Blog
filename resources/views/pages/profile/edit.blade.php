@extends('layout.auth')

@section('content')
    <h1 class="text-3xl font-bold text-center">Edit Profile</h1>

    <form action="{{ route('profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm"
                value="{{ old('name', $profile->name) }}">
            @error('name')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm"
                rows="4">{{ old('description', $profile->description) }}</textarea>
            @error('description')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="avatar" class="block text-sm font-medium text-gray-700">Avatar</label>
            <input type="file" name="avatar" id="avatar"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
            @if ($profile->avatar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Image" class="w-full h-auto rounded-md">
                </div>
            @endif

            @error('avatar')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <button type="submit"
                class="w-full px-3 py-2 text-white bg-cyan-600 rounded-md hover:bg-cyan-700 focus:outline-none focus:bg-cyan-700">Update</button>
        </div>
    </form>
@endsection
