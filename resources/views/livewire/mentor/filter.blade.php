<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
            <input type="text"
                wire:model.live.debounce.500ms="filters.search"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Search mentors...">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Skill</label>
            <select
                wire:model.live.debounce.500ms="filters.skill"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @foreach ($skills as $skill)
                    <option value="{{ $skill['value'] }}">{{ $skill['label'] }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Price Range <small class="text-gray-500">( Hourly Rate )</small>
            </label>
            <select
                wire:model.live.debounce.500ms="filters.price"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @foreach ($prices as $price)
                    <option value="{{ $price['value'] }}">{{ $price['label'] }}</option>
                @endforeach
            </select>
        </div>
        {{-- <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Availability</label>
            <select
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option>Any Time</option>
                <option>Available Now</option>
                <option>This Week</option>
                <option>Weekends</option>
            </select>
        </div> --}}
    </div>
    <div class="flex justify-between items-center mt-4">
        <div class="flex space-x-2">
            {{-- <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">JavaScript</span>
            <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">Available Now</span> --}}
        </div>
        <button
            wire:click="clearFilters"
            class="text-blue-600 hover:text-blue-700 text-sm font-medium cursor-pointer">
            Clear All Filters
        </button>
    </div>
</div>
