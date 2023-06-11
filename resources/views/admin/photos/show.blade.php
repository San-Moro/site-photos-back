@extends('layouts.admin')

@section('content')
    <div class="container">
        {{-- button to go back --}}
        <div>
            <a class="btn btn-secondary my-4" href="{{ url()->previous() }}">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
        {{-- Author --}}
        <h2>Autore: {{ Auth::user()->name }}</h2>
        {{-- Date --}}
        <p>Data: {{ $photo->created_at }}</p>
        {{-- Tags --}}
        <div class="tags">
            <span>Tags:</span>
            @forelse ($photo->tags as $tag)
                <span>#{{ $tag->name }}</span>
            @empty
                <span>Nessun Tag</span>
            @endforelse
        </div>
        {{-- image --}}
        <div class="text-center mt-4">
            <img class="w-50" src="{{ asset('storage/' . $photo->image)}}" alt="">
        </div>
    </div>
@endsection