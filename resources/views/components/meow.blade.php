<div class="card">
    <div class="card-body">
        @if (Auth::id() == $meow->user->id)
            <div class="px-3 py-3 absolute right-0 top-0 flex">
                <a href="{{ route('editMeow', $meow->id) }}">{{ __('Edit') }}</a>
                <button href="{{ route('deleteMeow', $meow->id) }}" class="ml-2" onclick="deleteMeow()">{{ __('Remove') }}</a>
            </div>
        @endif
        <p>{{ $meow->content }}</p>
        <div class="flex mt-4">
            @each('components.tag', $meow->tags, 'tag')
        </div>
    </div>
    <div class="flex px-3 justify-between items-baseline">
        <h6>User: {{ $meow->user->fullName }}</h6>
        <span>{{ $meow->created_at->diffForHumans() }}</span>
    </div>
</div>
<script>
    async function deleteMeow() {
        await fetch("{{ route('deleteMeow', $meow->id) }}", {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
            }
        });
        window.location.replace("{{ route('meows') }}");
    }
</script>
<style>
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.25rem;
    }
    .card-body {
        flex: 1 1 auto;
        padding: 1.25rem;
        position: relative;
    }
    .bg-blue-600 {
        --tw-bg-opacity: 1;
        background-color: rgb(37 99 235 / var(--tw-bg-opacity));
    }
</style>
