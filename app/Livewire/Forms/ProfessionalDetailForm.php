<?php

namespace App\Livewire\Forms;

use App\Actions\CreateMentorProfileAction;
use App\Models\User;
use Livewire\Form;

class ProfessionalDetailForm extends Form
{
    public string $current_role = '';

    public string $bio = '';

    public array $experiences = [];

    public function setInitialState(): void
    {
        $this->experiences[] = [
            'job_title' => '',
            'company_name' => '',
            'start_date' => '',
            'end_date' => '',
            'current_position' => false,
            'description' => '',
        ];
    }

    protected function rules(): array
    {
        return [
            'current_role' => ['required', 'string', 'max:255'],
            'bio' => ['required', 'string'],
            'experiences' => ['required', 'array'],
            'experiences.*.job_title' => ['required', 'string', 'max:255'],
            'experiences.*.company_name' => ['required', 'string', 'max:255'],
            'experiences.*.start_date' => ['required', 'date'],
            'experiences.*.end_date' => ['nullable', 'required_without:experiences.*.current_position', 'date'],
            'experiences.*.current_position' => ['boolean'],
            'experiences.*.description' => ['nullable', 'string'],
        ];
    }

    public function store(User $user)
    {
        $this->validate();

        $requestData = $this->all();

        (app(CreateMentorProfileAction::class))->execute($user, $requestData);
    }
}
