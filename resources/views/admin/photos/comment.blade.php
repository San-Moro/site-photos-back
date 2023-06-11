@extends('layouts.admin')

@section('content')
    <h2 class="text-center mt-4">Commenti ricevuti</h2>

    <div class="container d-flex">
        @foreach ($comments as $comment)
            <div class="card me-3 mt-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Title</h5>
                    <p class="card-text"> <span class="fw-bold">Commento : </span> {{ $comment->message }}</p>
                    <p class="card-text"><span class="fw-bold">Email :</span> {{ $comment->email }}</p>
                    <p class="card-text"><span class="fw-bold">Scritto il :</span>
                        {{ $comment->created_at->setTimezone('Europe/Rome')->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection