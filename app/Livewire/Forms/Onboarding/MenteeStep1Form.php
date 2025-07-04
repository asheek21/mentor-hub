<?php

namespace App\Livewire\Forms\Onboarding;

use App\Enums\LearningPreference;
use App\Enums\MenteeTimeline;
use App\Enums\SessionFrequency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Form;

class MenteeStep1Form extends Form
{
    public string $current_role = '';

    public string $current_status = '';

    public array $specialization = [
        'programming' => [],
        'design' => [],
        'career' => [],
        'others' => [],
    ];

    public string $learning_preference = LearningPreference::HANDSONPRACTICE->value;

    public string $session_frequency = SessionFrequency::WEEKLYSESSION->value;

    public string $learning_goal = '';

    public string $timeline = MenteeTimeline::ONE_TWO_MONTHS->value;

    public string $challenges = '';

    public string $bio = '';

    protected function rules(): array
    {
        return [
            'current_status' => ['required', 'string'],
            'current_role' => ['nullable', 'string'],
            'bio' => ['required', 'string'],
            'specialization' => ['required', 'array'],
            'learning_preference' => ['required', Rule::enum(LearningPreference::class)],
            'session_frequency' => ['required', Rule::enum(SessionFrequency::class)],
            'learning_goal' => ['required', 'string'],
            'challenges' => ['nullable', 'string'],
        ];
    }

    public function store()
    {
        $this->validate();

        $requestData = $this->all();

        $specialization = $requestData['specialization'];

        if (! empty($specialization['others'])) {
            $specialization['others'] = explode(',', $specialization['others']);
        }

        $requestData['specialization'] = $specialization;

        $user = Auth::user();

        $user->userProfile()->delete();

        $user->userProfile()->create([
            'current_role' => $requestData['current_role'] ?? null,
            'current_status' => $requestData['current_status'],
            'bio' => $requestData['bio'],
            'specialization' => $requestData['specialization'],
        ]);

        $user->menteePreference()->delete();

        $user->menteePreference()->create([
            'learning_preference' => $requestData['learning_preference'],
            'session_frequency' => $requestData['session_frequency'],
            'learning_goal' => $requestData['learning_goal'],
            'challenges' => $requestData['challenges'] ?? null,
            'timeline' => $requestData['timeline'],
        ]);
    }
}
