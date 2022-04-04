<div class="container p-4 mx-auto">
    {{-- {{ var_dump($meows) }} --}}
    @foreach ($meows as $meow)
        <x-meow :meow="$meow" />
    @endforeach
</div>
@if ($hasNext)
    @livewire('load-more-meows', ['page' => $page, 'perPage' => $perPage])
@endif
