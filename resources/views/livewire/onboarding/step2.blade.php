<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Set Your Availability</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Configure when you're available for mentoring sessions. You can always update this later.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <livewire:onboarding.schedule :user="$user" :weekDays="$weekDays"/>


        <!-- Sidebar -->
        <livewire:onboarding.schedule-preview :user="$user" :weekDays="$weekDays"/>

    </div>
</div>
