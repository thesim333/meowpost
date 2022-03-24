<div class="px-4 py-4">
    @foreach ($data as $meow)
        <x-meow :meow="$meow" />
    @endforeach
</div>
