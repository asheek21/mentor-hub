<?php

namespace App\Livewire\Mentor;

use Livewire\Component;

class Filter extends Component
{
    public array $filters = [
        'search' => '',
        'skill' => '',
        'price' => '',
    ];

    public function render()
    {
        $skills = $this->getSkills();

        $prices = $this->getPrice();

        return view('livewire.mentor.filter', compact('skills', 'prices'));
    }

    public function getSkills()
    {
        return [
            [
                'label' => 'All Skills',
                'value' => 'all',
            ],
            [
                'label' => 'JavaScript',
                'value' => 'javascript',
            ],
            [
                'label' => 'React',
                'value' => 'react',
            ],
            [
                'label' => 'Python',
                'value' => 'python',
            ],
            [
                'label' => 'Career Development',
                'value' => 'career development',
            ],
            [
                'label' => 'UX Design',
                'value' => 'ux design',
            ],
        ];
    }

    public function getPrice()
    {
        return [
            [
                'label' => 'Any price',
                'value' => 'all',
            ],
            [
                'label' => '₹0 - ₹500',
                'value' => '0-500',
            ],
            [
                'label' => '₹500 - ₹1000',
                'value' => '500-1000',
            ],
            [
                'label' => '1000+',
                'value' => 'high',
            ],
        ];
    }

    public function updatedFiltersSearch($search)
    {
        $this->filters['search'] = $search;
        $this->dispatchFilterEvent();
    }

    public function updatedFiltersSkill($skill)
    {
        $this->filters['skill'] = $skill;
        $this->dispatchFilterEvent();
    }

    public function updatedFiltersPrice($price)
    {
        $this->filters['price'] = $price;
        $this->dispatchFilterEvent();
    }

    public function clearFilters()
    {
        $this->filters = [
            'search' => '',
            'skill' => 'all',
            'price' => 'all',
        ];

        $this->dispatchFilterEvent();
    }

    public function dispatchFilterEvent()
    {
        $this->dispatch('appliedFilters', $this->filters)->to(Browse::class);
    }
}
