<?php

namespace App\Livewire\Onboarding\Mentor;

use App\Models\User;
use Livewire\Component;

class AccountStatus extends Component
{
    public User $user;

    public bool $accountStatus = true;

    public function mount()
    {
        $this->accountStatus = $this->user->mentorProfile->mentor_status;
    }

    public function render()
    {
        return view('livewire.onboarding.mentor.account-status');
    }

    public function updatedAccountStatus($value)
    {
        $this->user->mentorProfile()->update([
            'mentor_status' => $value,
        ]);
    }
}
