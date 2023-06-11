@extends('layouts.admin')

@section('content')
    <div class="container">
        {{-- button to go back --}}
        <div>
            <a class="btn btn-secondary mt-4" href="{{ route('admin.photos.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
        
        <h2 class="py-3 mt-3"> changes </h2>
        <div class="row">
            <div class="col-10">
                @include('partials.errors')
                
                <form action="{{ route('admin.photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Image --}}
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        {{-- Image Preview --}}
                        <div id="image-preview" >
                            <img class="w-50" src="{{ asset('storage/' . $photo->image) }}" alt="">
                        </div>
                    </div>

                    {{-- Tags --}}
                    <div class="form-group mb-3">
                        <h4>Tags</h4>
                        <div class="row row-cols-3">
                            @foreach ($tags as $tag)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="tags[]" id="tag-{{ $tag->id }}" value="{{ $tag->id }}" @checked($photo->tags->contains($tag))>
                                    <label for="tag-{{ $tag->id }}" class="form-check-label">{{ $tag->name }}</label>
                                </div>        
                            @endforeach
                        </div>
                        
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Save changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection