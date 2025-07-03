<?php

namespace App\Livewire\Onboarding;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Preview extends Component
{
    public User $user;

    public string $currentRole = '';

    public array $specialization = [];

    public ?float $hourlyRate = null;

    public int $sessionDuration = 60;

    public function render()
    {
        $profilePicture = $this->user->profile_picture;

        return view('livewire.onboarding.preview', [
            'profilePicture' => $profilePicture,
        ]);
    }

    #[On('onboarding-step1-updated')]
    public function step1Datas($datas)
    {
        $this->currentRole = $datas['currentRole'];

        $specialization = $datas['specilization'];

        $flat = collect($specialization)
            ->flatMap(function ($item) {
                if (is_array($item)) {
                    return $item;
                }

                return [$item];
            })
            ->filter()
            ->values()
            ->take(2);

        $this->specialization = $flat->all();

        $this->hourlyRate = $datas['hourlyRate'];

        $this->sessionDuration = $datas['sessionDuration'];
    }

    #[On('profile-picture-updated')]
    public function profilePictureUpdated()
    {
        $this->user->refresh();
    }
}
