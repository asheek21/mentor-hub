<?php

namespace App\Livewire\Settings\Mentee;

use App\Enums\MenteeCurrentStatus;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class PersonalInformation extends Component
{
    public User $user;

    public string $first_name;

    public string $last_name;

    public string $email;

    public string $current_role;

    public string $bio;

    public string $current_status;

    public function mount()
    {
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
        $this->current_role = $this->user->menteeProfile->current_role;
        $this->bio = $this->user->menteeProfile->bio;
        $this->current_status = $this->user->menteeProfile->current_status->value;

    }

    public function render()
    {
        $currentStatuses = MenteeCurrentStatus::cases();

        return view('livewire.settings.mentee.personal-information', compact(
            'currentStatuses'
        ));
    }

    public function updatePersonalInformation()
    {
        $this->validate();

        $this->user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);

        $this->user->menteeProfile->update([
            'current_role' => $this->current_role,
            'bio' => $this->bio,
            'current_status' => $this->current_status,
        ]);

        Toaster::success('Profile updated!');
    }

    protected function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'current_role' => 'nullable|string|max:255',
            'bio' => 'required',
            'current_status' => ['required', Rule::enum(MenteeCurrentStatus::class)],
        ];
    }
}
