<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Profile Settings</h2>
        <p class="text-gray-600">Manage your account settings and preferences</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <livewire:settings.sidebar :user="$user" :tab="$tab" />

        <div class="lg:col-span-3">
            @if ($tab == 'personal-information')
                <livewire:settings.mentee.personal-information :user="$user" />
            @elseif ($tab == "interests")
                <livewire:onboarding.mentee.interest :user="$user" />
            @elseif($tab == "learning-preference")
                <livewire:onboarding.mentee.Preference :user="$user" />
            @elseif($tab == "appearance")
                <livewire:settings.appearance />
            @endif
        </div>
    </div>
</div>
