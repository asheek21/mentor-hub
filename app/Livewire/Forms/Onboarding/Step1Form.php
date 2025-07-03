<?php

namespace App\Livewire\Forms\Onboarding;

use App\Enums\YearsOfExperience;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class Step1Form extends Form
{
    #[Validate('required|string|max:255')]
    public string $current_role = '';

    public string $company = '';

    public string $years_of_experience = '';

    public string $bio = '';

    public array $specialization = [
        'programming' => [],
        'design' => [],
        'career' => [],
        'others' => [],
    ];

    public ?float $hourly_rate = null;

    public int $session_duration = 60;

    protected function rules(): array
    {
        return [
            'company' => ['required', 'string', 'max:255'],
            'years_of_experience' => ['required', Rule::enum(YearsOfExperience::class)],
            'bio' => ['required', 'string'],
            'specialization' => ['required', 'array'],
            'hourly_rate' => ['required', 'numeric'],
            'session_duration' => ['required', 'numeric'],
        ];
    }

    public function store()
    {
        $this->validate();

        if (
            empty($this->specialization['programming']) &&
            empty($this->specialization['design']) &&
            empty($this->specialization['career']) &&
            empty($this->specialization['others'])
        ) {
            $this->addError('specialization', 'Please select at least one specialization or fill in "Others".');

            return;
        }

        $requestData = $this->all();

        $specialization = $requestData['specialization'];

        if (! empty($specialization['others'])) {
            $specialization['others'] = explode(',', $specialization['others']);
        }

        $requestData['specialization'] = $specialization;

        $user = Auth::user();

        $user->userProfile()->delete();

        $user->userProfile()->create($requestData);
    }
}
