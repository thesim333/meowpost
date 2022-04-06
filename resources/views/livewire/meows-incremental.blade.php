<div id="incremental" class="container p-4 mx-auto" data-page="{{ $page }}" data-more="{{ $more }}">
    @foreach ($meows as $meow)
        <span>{{ $loop->index }}</span>
        <x-meow :meow="$meow" />
    @endforeach
</div>
<div id="removableScripts">
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
</div>
