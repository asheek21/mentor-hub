<div class="flex justify-between items-center mb-6">
    <p class="text-gray-600">Showing 24 mentors</p>
    <div class="flex items-center space-x-4">
        <span class="text-sm text-gray-500">Sort by:</span>
        <select
            wire:model.live.debounce.500ms="sort"
            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @foreach ($sorts as $sort)
                <option value="{{ $sort['value'] }}">{{ $sort['label'] }}</option>
            @endforeach
        </select>
    </div>
</div>
