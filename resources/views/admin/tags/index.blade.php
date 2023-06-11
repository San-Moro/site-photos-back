@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        {{-- form add new tag --}}
        <div class="col-6 mb-4">
            <h2 class="mt-4">Add a new tag</h2>
            <form action="{{ route('admin.tags.store') }}" method="POST" class="mt-3">
                @csrf
                @include('partials.messages')
                <div class="input-group">
                    <input type="text" name="name" class="form-control" placeholder="Add a new tag" aria-label="Add a new tag" aria-describedby="create-tag-btn">
                    <button class="btn btn-outline-primary" type="submit" id="create-tag-btn">Save</button>
                </div>
            </form>
        </div>

        {{-- table with actions of tags --}}
        <div class="col-10">
            <h2 class="mt-4">List of all tags</h2>
            <table class="table mt-5 text-center">
                <thead>
                    <tr>
                        <th scope="col">Tag</th>
                        <th scope="col">N. photo with this tag</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @forelse ($tags as $tag)
                        <tr>
                            <th scope="row">
                                <form id="edit-tag-{{ $tag->id }}" action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $tag->name }}">
                                    <label for=""></label>
                                </form>
                            </th>
                            <td>{{ count($tag->photos) }}</td>
                            {{-- buttons of actions --}}
                            <td class="d-flex py-4 justify-content-center">
                                {{-- show's button --}}
                                <a class="btn btn-dark" href="{{ route('admin.tags.show', $tag->id) }}">
                                    <i class="fa-solid fa-eye"></i></a>
                                {{-- edit's button --}}
                                <button form="edit-tag-{{ $tag->id }}" class="btn btn-warning mx-2" href="" type="submit">Conferma modifica
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                {{-- delete's button --}}
                                <form action="{{route('admin.tags.destroy', $tag->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                
                                </form>
                            </td>
                        </tr>
                    @empty
                        <p>no tag</p>
                    @endforelse
                    
                </tbody>
            </table>
            <div class="pagination justify-content-end">
                {{ $tags->links() }}
            </div>
        </div>
    </div>
    
</div>
@endsection