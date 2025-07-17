<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body>

</body>

    @if (! auth('web')->check() )
        <livewire:landing.header />
    @else
        <livewire:auth.header />
    @endif

    {{ $slot }}

    {{-- <flux:toast position="top right"/> --}}

    <x-toaster-hub />

    @stack('custom-script')

    @fluxScripts
</html>
