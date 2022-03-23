<div class="card">
    <div class="card-body">
        <p>{{ $meow->content }}</p>
    </div>
    <div class="d-flex px-3 justify-content-between align-items-baseline">
        <h6>User: {{ $meow->user->fullName }}</h6>
        <span>{{ $meow->created_at->diffForHumans() }}</span>
    </div>
</div>
