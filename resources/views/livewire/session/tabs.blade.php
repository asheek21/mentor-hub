<div class="border-b border-gray-200">
    <nav class="flex space-x-8 p-6">
        @foreach ($tabs as $tab)

            @php
                $isActive = $currentTab === $tab['query']
                    || (empty($currentTab) && $tab['query'] === 'all-sessions');
            @endphp

            <button
                @class([
                    "cursor-pointer",
                    "text-gray-500 hover:text-gray-700 pb-2" => ! $isActive,
                    "text-blue-600 border-b-2 border-blue-600 pb-2 font-medium" => $isActive,
                ])
                wire:click="changeTab('{{ $tab['query'] }}')"
            >
                {{ $tab['name'] }}
            </button>
        @endforeach
    </nav>
</div>
