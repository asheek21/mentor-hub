<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <livewire:mentor-profile.hero :user="$user" />

            <livewire:mentor-profile.about :user="$user" />

            <livewire:mentor-profile.experience :user="$user" />

            <livewire:mentor-profile.reviews :user="$user" />
        </div>

        <!-- Booking Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-8">
                <livewire:mentor-profile.summary :user="$user" />

                <livewire:mentor-profile.availability :user="$user" />

                <livewire:mentor-profile.quick-stats :user="$user" />
            </div>
        </div>
    </div>
</div>
