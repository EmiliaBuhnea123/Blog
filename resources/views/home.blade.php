@extends('layout.app')

@section('title', 'Pagina principala')

@section('content')

    @auth
        <p class="text-center text-amber-600 text-2xl font-bold mt-4">Welcome {{ auth()->user()->name }}</p>

        <form action="{{ route('home') }}" method="GET">
            @csrf
            <div class="mb-4 mt-4">
                <div class="flex justify-center">
                <select name="category_id" id="category" class="justify-center text-center w-80 mt-1 h-14">
                    <option value="">Selectează categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            </div>
            <div class="flex justify-center">
                <button type="submit"
                    class="w-80 h-10 justify-center text-center bg-slate-600 text-white font-semibold rounded-md hover:bg-slate-700">
                    Filtrează
                </button>
            </div>
        </form>

    @endauth

    @guest
        <h1 class="text-center text-cyan-800 text-4xl italic mt-8">Fă parte din comunitatea noastră</h1>
    @endguest

    @foreach ($articles as $item)
        <div class="container max-w-6xl mx-auto my-5 p-5 bg-slate rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-cyan-800">{{ $item->title }}</h2>

            @auth
                <p class="mt-2 text-gray-600">{{ $item->description }}</p>
                @if ($item->image)
                    <div class="mb-5">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                            class="w-full h-auto rounded-md">
                    </div>
                @endif

                <h3 class="font-bold text-cyan-700 text-xl">Comentarii</h3>
                @if ($item->comments->isNotEmpty())
                    <ul>
                        @foreach ($item->comments as $comment)
                            <li class="font-bold text-amber-600">{{ $comment->user->name ?? 'Anonim' }}</li>
                            <li>{{ $comment->comment }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>nu exista comentarii</p>
                @endif

                <h1 class="text-2xl text-slate-900 font-bold mb-5">Adaugă un comentariu</h1>
                <form action="{{ route('pages.comments.store', $item->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <textarea name="comment" cols="30" rows="5"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-amber-600"></textarea>
                    </div>
                    <div class="mb-4">
                        <button type="submit"
                            class="w-full bg-amber-600 text-white font-semibold py-2 rounded-md hover:bg-amber-700 focus:outline-none">Submit</button>
                    </div>
                </form>

                <form action="{{ route('pages.destroy', $item->id) }}" method="POST">
                    @csrf

                    @can('view-all-profiles')
                        @method('DELETE')
                        <button type="submit" class=" bg-amber-400 p-3 rounded-md">Delete</button>
                    @endcan

                </form>
            @endauth

            @guest
                <p class="mt-2 text-gray-600">{{ Str::limit($item->description, 500) }}</p>
                <a href="{{ route('auth.register') }}" class="text-cyan-600">Citește mai mult</a>
            @endguest
        </div>
    @endforeach

@endsection
