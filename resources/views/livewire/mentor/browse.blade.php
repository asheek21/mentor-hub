<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Find Your Perfect Mentor</h2>
        <p class="text-gray-600">Discover experienced professionals who can guide your learning journey</p>
    </div>

    <livewire:mentor.filter />

    <livewire:mentor.sort />

    <livewire:mentor.listing :filters="$filters" />
</div>
