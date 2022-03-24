<div class="max-w-2xl px-4 py-4 mx-auto">
    @foreach ($data as $meow)
        <x-meow :meow="$meow" />
    @endforeach
</div>
