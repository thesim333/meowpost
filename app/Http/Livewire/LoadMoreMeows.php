<?php

namespace App\Http\Livewire;

use App\Models\Meow;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class LoadMoreMeows extends Component
{
    use WithPagination;
    public $perPage;
    public $page = 1;
    public $loadMore = false;
    public $tag;
    protected $queryString = ['tag'];

    public function mount($page = null, $perPage = null)
    {
        $this->page = $page ?? 1;
        $this->perPage = $perPage ?? 10;
    }

    public function loadMore()
    {
        $this->page += 1;
        $this->loadMore = true;
    }

    protected $listeners = [
        'load-more' => 'loadMore',
        'loadMore' => 'loadMore',
    ];

    public function render()
    {
        if (!$this->loadMore) {
            return view('livewire.load-more-meows');
        } else {
            $meows = Meow::when($this->tag, function ($query, $tag) {
                $query->whereHas('tags', function (Builder $q) use ($tag) {
                    $q->where('tag', '=', $tag);
                });
            })
            ->with(['user', 'tags'])
            ->latest()
            ->paginate($this->perPage, ['*'], null, $this->page);

            return view('livewire.meows', ['meows' =>  $meows, 'hasNext' => $meows->hasMorePages()]);
        }
    }
}
