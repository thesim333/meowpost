<div class="card">
    <div class="card-body">
        @if (Auth::id() == $meow->user->id)
            <a href="{{ route('editMeow', $meow->id) }}" class="px-3 py-3 absolute right-0 top-0">{{ __('Edit') }}</a>
        @endif
        <p>{{ $meow->content }}</p>
    </div>
    <div class="flex px-3 justify-between items-baseline">
        <h6>User: {{ $meow->user->fullName }}</h6>
        <span>{{ $meow->created_at->diffForHumans() }}</span>
    </div>
</div>
