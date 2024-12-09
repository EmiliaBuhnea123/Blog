@extends('layout.app')

@section('title', 'My profile')

@section('content')
    <h1 class="text-3xl font-bold text-center text-amber-600 mt-6">Profilul meu</h1>

    <div class="container max-w-6xl mx-auto my-5 p-5 bg-slate rounded-lg shadow-lg">
    @if ($profiles)
        <div class="mb-4">
            <h2 class="text-xl font-semibold">{{ $profiles->name }}</h2>
            <p>{{ $profiles->description }}</p>

            @if ($profiles->avatar)
                <img src="{{ asset('storage/' . $profiles->avatar) }}" alt="Avatar" class="mt-2 w-32 h-32 rounded-full">
            @endif

            <a href="{{ route('profile.edit', $profiles->id) }}" 
                class="mt-4 inline-block px-6 py-2 bg-amber-600 text-white rounded-lg shadow hover:bg-amber-700">
                 Editează profilul
             </a>
        </div>
    </div>
    @else
        <p>Nu există informatii despre profil.</p>
    @endif
@endsection
