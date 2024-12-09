​@extends('layout.auth')

@section('content')
<h1 class="text-3xl font-bold text-center">Login</h1>
<form  method="POST">
    @csrf
    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm" required>
        @error('email')
            <p class="text-red-500">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm" required>
        @error('password')
            <p class="text-red-500">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <button type="submit" class="w-full px-3 py-2 text-white bg-cyan-600 rounded-md hover:bg-cyan-700 focus:outline-none focus:bg-cyan-700">Login</button>
    </div>
</form>
@endsection