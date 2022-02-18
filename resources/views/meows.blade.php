@extends('page')

@section('title', 'Latest Meows!')

@section('heading', 'Latest Meows')

@section('content')
    <main>
        @foreach ($data as $meow)
            <div class="card">
                <div class="card-body">
                    <p>{{ $meow->content }}</p>
                </div>
                <div class="d-flex px-3 justify-content-between align-items-baseline">
                    <h6>User: {{ $meow->user_id }}</h6>
                    <span>{{ $meow->created_at->diffForHumans() }}</span>
                </div>
            </div>
        @endforeach
    </main>
@endsection