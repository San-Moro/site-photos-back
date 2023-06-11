@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="py-3 text-start mt-4">List of All Photos</h2>
        <div class="text-start mb-3">
            <a class="btn btn-primary btn-lg" href="{{route('admin.photos.create')}}">
                <i class="fa-solid fa-plus"></i>
                Add New
            </a>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-10">
                @include('partials.messages')
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Author</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($photos as $photo)
                            <tr>
                                {{-- photo --}}
                                <td class="w-50">
                                    <img class="w-50" src="{{ asset('storage/' . $photo->image)}}" alt="">
                                </td>
                                {{-- Author --}}
                                <td>{{ Auth::user()->name }}</td>
                                {{-- Date --}}
                                <td>{{ $photo->created_at }}</td>
                                
                                {{-- Actions --}}
                                <td>
                                    <a class="btn btn-dark" href="{{ route('admin.photos.show', $photo->id) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a class="btn btn-warning" href="{{ route('admin.photos.edit', $photo->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-photo-{{$photo->id}}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete-photo-{{$photo->id}}" tabindex="-1" aria-labelledby="delete-label-{{$photo->id}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title fs-5" id="delete-label-{{$photo->id}}">Sei sicuro di voler eliminare?</h2>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

                                                    <form action="{{route('admin.photos.destroy', $photo->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-primary">
                                                            Conferma
                                                        </button>
                                                    
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination justify-content-end">
                    {{ $photos->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection