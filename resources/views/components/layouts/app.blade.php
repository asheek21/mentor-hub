<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body>

</body>
    {{ $slot }}

    {{-- <flux:toast position="top right"/> --}}

    <x-toaster-hub />

    @fluxScripts
</html>
