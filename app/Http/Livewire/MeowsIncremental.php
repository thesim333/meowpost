<?php

namespace App\Http\Livewire;

use App\Models\Meow;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class MeowsIncremental extends Component
{
    use WithPagination;
    public $page = 1;
    public $perPage;
    public $tag;
    protected $queryString = ['page', 'tag'];

    /**
     * lifecycle hook runs once
     *
     * @param int|null $perPage
     * @return void
     */
    public function mount($perPage = null)
    {
        $this->perPage = $perPage ?? 20;
    }

    public function loadMore()
    {
        $this->page += 1;
    }

    protected $listeners = [
        'load-more' => 'loadMore',
        'loadMore' => 'loadMore',
    ];

    /**
     * lifecycle hook runs before tag updated
     * reset pagination
     *
     * @return void
     */
    public function updatingTag()
    {
        $this->resetPage();
    }

    public function render()
    {
        $meows = Meow::when($this->tag, function ($query, $tag) {
            $query->whereHas('tags', function (Builder $q) use ($tag) {
                $q->where('tag', '=', $tag);
            });
        })
            ->with(['user', 'tags'])
            ->latest()
            ->paginate($this->page * $this->perPage);

        return view('livewire.meows-incremental', ['meows' => $meows, 'more' => $meows->hasMorePages()]);
    }
}
