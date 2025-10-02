<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <livewire:mentor-profile.hero :mentor="$mentor" />

            <livewire:mentor-profile.about :mentor="$mentor" />

            <livewire:mentor-profile.experience :mentor="$mentor" />

            <livewire:mentor-profile.reviews :mentor="$mentor" />
        </div>

        <!-- Booking Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-8">
                <livewire:mentor-profile.summary :mentor="$mentor" />

                <livewire:mentor-profile.availability :mentor="$mentor" />

                <livewire:mentor-profile.quick-stats :mentor="$mentor" />
            </div>
        </div>
    </div>
</div>

