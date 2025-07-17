<?php

namespace App\Livewire\Forms\Onboarding;

use App\Actions\UpdateMenteePreferenceAction;
use App\Enums\LearningPreference;
use App\Enums\SessionFrequency;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Form;

class MenteePreferenceForm extends Form
{
    public string $learning_preference = LearningPreference::HANDSONPRACTICE->value;

    public string $session_frequency = SessionFrequency::WEEKLYSESSION->value;

    public string $learning_goal = '';

    public string $challenges = '';

    protected function rules(): array
    {
        return [
            'learning_preference' => ['required', Rule::enum(LearningPreference::class)],
            'session_frequency' => ['required', Rule::enum(SessionFrequency::class)],
            'learning_goal' => ['required', 'string'],
            'challenges' => ['nullable', 'string'],
        ];
    }

    public function store(User $user)
    {
        $this->validate();

        app(UpdateMenteePreferenceAction::class)->execute($user, $this->all());
    }
}
