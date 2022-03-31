<div class="flex justify-center">
    @foreach ($tags as $tag)
        <x-tag-link :tag="$tag" />
    @endforeach
</div>
