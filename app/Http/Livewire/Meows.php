<?php

namespace App\Http\Livewire;

use App\Models\Meow;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Meows extends Component
{
    use WithPagination;
    public $tag;
    protected $queryString = ['tag'];

    public function mount($page = null, $perPage = null)
    {
        $this->page = $page ?? 1;
        $this->perPage = $perPage ?? 20;
    }

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
            ->paginate($this->perPage, ['*'], null, $this->page);

        return view('livewire.meows', ['meows' =>  $meows, 'hasNext' => $meows->hasMorePages()]);
    }
}
