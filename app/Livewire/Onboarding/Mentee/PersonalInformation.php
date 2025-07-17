<?php

namespace App\Livewire\Onboarding\Mentee;

use App\Actions\CreateMenteeProfileAction;
use App\Enums\MenteeCurrentStatus;
use App\Livewire\Onboarding\OnboardingPage;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class PersonalInformation extends Component
{
    public User $user;

    public string $current_status = '';

    public string $current_role = '';

    public string $bio = '';

    public function render()
    {
        $menteeCurrentStatus = MenteeCurrentStatus::cases();

        return view('livewire.onboarding.mentee.personal-information', compact(
            'menteeCurrentStatus'
        ));
    }

    protected function rules()
    {
        return [
            'current_status' => ['required', Rule::enum(MenteeCurrentStatus::class)],
            'current_role' => ['nullable', 'string'],
            'bio' => ['required', 'string'],
        ];
    }

    public function storePersonalInformation()
    {
        $this->validate();

        app(CreateMenteeProfileAction::class)->execute($this->user, [
            'current_status' => $this->current_status,
            'current_role' => $this->current_role,
            'bio' => $this->bio,
        ]);

        Toaster::success('profile updated!');

        $this->dispatch('profile-updated', [
            'completedStep' => 1,
        ])->to(OnboardingPage::class);
    }

    public function previewUpdates()
    {
        $currentRole = $this->current_role;

        $this->dispatch('onboarding-step1-updated', [
            'currentRole' => $currentRole,
        ]);
    }
}
