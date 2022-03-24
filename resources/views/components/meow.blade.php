<div class="card">
    <div class="card-body">
        <p>{{ $meow->content }}</p>
    </div>
    <div class="flex px-3 justify-between items-baseline">
        <h6>User: {{ $meow->user->fullName }}</h6>
        <span>{{ $meow->created_at->diffForHumans() }}</span>
    </div>
</div>
