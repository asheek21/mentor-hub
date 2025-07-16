<div>
    <livewire:onboarding.header :currentStep="$currentStep" :totalStep="$totalStep" />

    @if ($user->isMentor())
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Welcome to MentorHub! 🎉</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Let's set up your mentor profile so students can discover your expertise and book sessions with you.
            </p>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
                <div class="lg:col-span-2">

                    @if($currentStep == 1 )
                        <livewire:profile-picture :user="$user" />

                        <livewire:onboarding.mentor.personal-information :user="$user"/>
                    @elseif($currentStep == 2)
                        <livewire:onboarding.mentor.specialization :user="$user"/>
                    @elseif($currentStep == 3)
                        <livewire:onboarding.mentor.pricing :user="$user"/>
                    @endif
                </div>

                <livewire:onboarding.preview :user="$user" />
            </div>
        </div>
    @endif

    {{-- @if($currentStep == 1 )
        @if ( ! $isMentee )
            <livewire:onboarding.step1 :user="$user" />
        @else
            <livewire:onboarding.mentee.step1 :user="$user" />
        @endif

    @elseif($currentStep == 2)
        <livewire:onboarding.step2 :user="$user"/>
    @endif --}}
</div>


