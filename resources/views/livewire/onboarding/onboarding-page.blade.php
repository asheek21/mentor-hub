<div>
    <livewire:onboarding.header :currentStep="$currentStep" :totalStep="$totalStep" />

    @if($currentStep == 1 )
        @if ( ! $isMentee )
            <livewire:onboarding.step1 :user="$user" />
        @else
            <livewire:onboarding.mentee.step1 :user="$user" />
        @endif

    @elseif($currentStep == 2)
        <livewire:onboarding.step2 :user="$user"/>
    @endif
</div>
