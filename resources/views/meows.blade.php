@extends('page')

@section('title', 'Latest Meows!')

@section('heading', 'Latest Meows')

@section('content')
    <main>
        @foreach ($data as $meow)
            @include('meow', ['meow' => $meow])
        @endforeach
    </main>
@endsection