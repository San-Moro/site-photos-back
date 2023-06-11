@extends('layouts.admin')

@section('content')
    <div class="container">
        {{-- button to go back --}}
        <div>
            <a class="btn btn-secondary my-4" href="{{ url()->previous() }}">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
        <h2>{{ $tag->name }}</h2>
        <h4>Photo with <strong>#{{ $tag->name }}</strong> Tag</h4>
        <ol>
            @forelse ($tag->photos as $photo)
                <li>
                    <a href="{{ route('admin.photos.show', $photo->id) }}">
                        <img class="w-50 my-2" src="{{ asset('storage/' . $photo->image)}}" alt="">
                    
                    </a>
                </li>
            @empty
                <p>There aren't photo whit this tag</p>
            @endforelse
            
        </ol>
    </div>
@endsection