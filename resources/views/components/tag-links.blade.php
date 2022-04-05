<div class="flex justify-center">
    @foreach ($tags as $tag)
        <x-tag-link :tag="$tag" />
    @endforeach
    <div
        class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase tracking-widest">
        <a href="{{ route('meows') }}">{{ __('Clear X') }}</a>
    </div>
</div>
