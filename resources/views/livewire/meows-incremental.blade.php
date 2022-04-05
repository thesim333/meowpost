<div class="container p-4 mx-auto">
    @foreach ($meows as $meow)
        <x-meow :meow="$meow" />
    @endforeach
</div>
{{ $more }}
@if ($meows->hasMorePages())
    <button wire:click.prevent="loadMore">Load more</button>
    <div id="intersection" x-data="{
        checkScroll() {
            window.onscroll = function(ev) {
                //document.body.scrollHeight worked for me insted of document.body.offsetHeight
                if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight) {
                    @this.call('loadMore');
                }
            }
        }
    }" x-init="checkScroll"></div>
@endif
