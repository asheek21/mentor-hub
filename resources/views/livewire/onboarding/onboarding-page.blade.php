<div>
    <livewire:onboarding.header :currentStep="$currentStep" :totalStep="$totalStep" />

    @if($currentStep == 1)
        <livewire:onboarding.step1 :user="$user" />
    @elseif($currentStep == 2)
        <livewire:onboarding.step2 :user="$user"/>
    @endif
</div>
