<?php

namespace App\Livewire\Mentor;

use App\Livewire\Components\BaseComponent;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;

class Browse extends BaseComponent
{
    use AuthorizesRequests;

    public array $filters = [
        'sort' => 'recommended',
    ];

    public function mount()
    {
        $this->authorize('browseMentor', User::class);
    }

    public function render()
    {
        return view('livewire.mentor.browse');
    }

    #[On('appliedFilters')]
    public function appliedFilters(array $filters)
    {
        $this->filters = array_merge($this->filters, $filters);
    }

    #[On('appliedSort')]
    public function appliedSort(string $sort)
    {
        $this->filters['sort'] = $sort;
    }
}
