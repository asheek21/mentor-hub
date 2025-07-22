<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body>
    @if (! auth('web')->check() )
        <livewire:landing.header />
    @else
        <livewire:auth.header />
    @endif

    {{ $slot }}

    {{-- <flux:toast position="top right"/> --}}

    <x-toaster-hub />

    @vite(['resources/js/stripe.js'])

    @stack('custom-script')

    @fluxScripts
</body>
</html>
