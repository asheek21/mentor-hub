<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <livewire:components.banner title="Welcome back, {{ $user->full_name }} 👋" :message="$bannerMessage" />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach ($stats as $stat )
            <livewire:components.stat-card label="{{ $stat['label'] }}" stat="{{ $stat['stat'] }}" icon="{{ $stat['icon'] }}" iconColor="{{ $stat['iconColor'] }}" />
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <livewire:dashboard.upcoming-sessions />
        </div>

        <div class="space-y-8">
            @if ($user->isMentor())
                <livewire:dashboard.recent-reviewes />
            @else
                <livewire:dashboard.recommended-mentors />
            @endif

            <livewire:dashboard.recent-messages />
        </div>
    </div>

</div>
