<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-900">Upcoming Sessions</h3>
            {{-- <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</a> --}}
        </div>

        <div class="p-6">
            <div class="space-y-4">
                <livewire:components.upcoming-session-card />
            </div>
        </div>
    </div>
</div>
