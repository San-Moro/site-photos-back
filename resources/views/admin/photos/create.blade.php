@extends('layouts.admin')

@section('content')
    <div class="container">
        {{-- button to go back --}}
        <div>
            <a class="btn btn-secondary mt-4" href="{{ route('admin.photos.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
        
        <h2 class="py-3 mt-3">Add New</h2>
        <div class="row">
            <div class="col-10">
                @include('partials.errors')
                <form action="{{ route('admin.photos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- input to add Image --}}
                    <div class="form-group mb-3">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div> 
                        @enderror
                    </div>
                    {{-- image preview --}}
                    <div class="mt-3">
                        <img id="img_preview" src="" alt="" style="max-height:200px">
                    </div>

                    {{-- Tags --}}
                    <div class="form-group mb-3">
                        <h4>Tags</h4>
                        <div class="row row-cols-3">
                            @foreach ($tags as $tag)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="tags[]" id="tag-{{ $tag->id }}" value="{{ $tag->id }}">
                                    <label for="tag-{{ $tag->id }}" class="form-check-label">{{ $tag->name }}</label>
                                </div>        
                            @endforeach
                        </div>
                        
                    </div>

                    <button class="btn btn-primary mt-3 " type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection