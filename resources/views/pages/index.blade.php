@extends('layout.app')

@section('title', 'Tasks')

@section('content')

@if (session()->has('success'))
    <div class="alert alert-success text-red-500 text-center py-3 px-6 rounded-md mt-4">
        {{ session('success') }}
    </div>
@endif

    <ul class="flex flex-col">
        @foreach ($articles as $item)
            <li class="mb-5 mt-6 ml-8">
                <a href="{{ route('pages.show', $item->id) }}">{{ $item->title }}</a>
                <div class="flex flex-row gap-3">
                    <div class="flex flex-row gap-3 mt-4 p-1">
                        <a href="{{ route('pages.show', $item->id) }}" class=" bg-amber-500 text-white p-3 rounded-md">Show</a>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
