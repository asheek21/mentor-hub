<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <livewire:components.page-header
        header="My Sessions"
        description="View and manage your sessions here."
    />

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        @foreach ($stats as $stat )
            <livewire:components.stat-card
                wire:key="stat-{{ $stat['label'] }}"
                label="{{ $stat['label'] }}" stat="{{ $stat['stat'] }}" icon="{{ $stat['icon'] }}" iconColor="{{ $stat['iconColor'] }}"
            />
        @endforeach
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
         <livewire:session.tabs />

        <div class="p-6">
            <livewire:session.listing :tab="$tab" />
        </div>
    </div>

</div>
