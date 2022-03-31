<div class="inline-flex items-center px-4 py-2 bg-blue-600 border rounded-md font-semibold text-xs text-white uppercase tracking-widest">
    <a href="{{ route('meows', ['tag' => $tag->tag]) }}">{{ $tag->tag }} ({{ $tag->meows_count }})</a>
</div>
