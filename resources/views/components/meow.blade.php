<div class="card">
    <div class="card-body">
        @if (Auth::id() == $meow->user->id)
            <div class="px-3 py-3 absolute right-0 top-0 flex">
                <a href="{{ route('editMeow', $meow->id) }}">{{ __('Edit') }}</a>
                <button href="{{ route('deleteMeow', $meow->id) }}" class="ml-2" onclick="deleteMeow()">{{ __('Remove') }}</a>
            </div>
        @endif
        <p>{{ $meow->content }}</p>
    </div>
    <div class="flex px-3 justify-between items-baseline">
        <h6>User: {{ $meow->user->fullName }}</h6>
        <span>{{ $meow->created_at->diffForHumans() }}</span>
    </div>
</div>
<script>
    async function deleteMeow() {
        console.log("{{ route('deleteMeow', $meow->id) }}", "{{ csrf_token() }}");
        await fetch("{{ route('deleteMeow', $meow->id) }}", {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
            }
        });
        window.location.replace("{{ route('meows') }}");
    }
</script>
