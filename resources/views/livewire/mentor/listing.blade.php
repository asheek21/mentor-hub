<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach ($mentors as $mentor)
        <livewire:components.mentor-card :mentor="$mentor" wire:key="mentor-{{ $mentor->id }}"/>
    @endforeach

    {{ $mentors->links() }}
</div>
