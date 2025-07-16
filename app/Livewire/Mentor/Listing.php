<?php

namespace App\Livewire\Mentor;

use App\Models\User;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    #[Reactive]
    public array $filters = [];

    public function render()
    {
        $mentors = User::query()
            ->select(['id', 'first_name', 'last_name', 'email', 'user_role'])
            ->mentor()
            ->when($this->filters, function ($query, $filters) {
                $this->queryFilters($query, $filters);
            })
            ->with(['mentorProfile' => function ($query) {
                $query->select(['current_role', 'company', 'bio', 'hourly_rate', 'current_status', 'user_id', 'specialization']);
            }])
            ->withCount(['userRatings' => function ($query) {
                $query->where('rated_user_id', '>', 0);
            }])
            ->paginate();

        return view('livewire.mentor.listing', compact('mentors'));
    }

    private function queryFilters($query, $filters)
    {
        if (isset($filters['search']) && $filters['search'] != '') {
            $query->where(function ($query) use ($filters) {
                $query->where('first_name', 'ilike', '%'.$filters['search'].'%')
                    ->orWhere('last_name', 'ilike', '%'.$filters['search'].'%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$filters['search']}%"]);
            });
        }

        if (isset($filters['skill']) && $filters['skill'] != 'all') {
            $query->whereHas('mentorProfile', function ($query) use ($filters) {
                // $query->whereRaw("specialization::text ILIKE ANY(?)", [
                //     array_map(fn($skill) => '%' . $skill . '%', $filters['skill'])
                // ]); //for multiple skills

                $query->whereRaw('specialization::text ILIKE ?', ["%{$filters['skill']}%"]);
            });

        }

        if (isset($filters['price']) && $filters['price'] != 'all') {
            $price = $filters['price'];

            $query->whereHas('mentorProfile', function ($query) use ($price) {

                if ($price == 'high') {
                    $query->where('hourly_rate', '>', 1000);

                } else {

                    $price = explode('-', $price);

                    $query->whereBetween('hourly_rate', [$price[0], $price[1]]);
                }
            });

        }
    }
}
