@extends('page')

@section('title', 'Post New Meow')

@section('heading', 'What do you want to Meow about today?')

@section('content')
    <main>
        <form method="POST" action="{{url("/users/$id/meows")}}">
            <div class="mb-3">
                <label for="meow-content" class="form-label">New Meow</label>
                <textarea id="meow-content" class="form-control" aria-label="New Meow" name="content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Meow!</button>
        </form>
    </main>
@endsection