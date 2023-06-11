@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        
                        <h2>Hello {{ Auth::user()->name }}! </h2><br>
                        <h3>{{ __('You are logged in!') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection