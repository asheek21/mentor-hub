<div class="@if ( in_array(request()->route()->getName(), $dontShowHeader) )
    hidden
@endif">
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-900">mentorLog</h1>
                </div>
                <nav class="hidden md:flex space-x-8">
                    @foreach ($menu as $menuItem)

                        @php
                            $isActive = request()->routeIs($menuItem['route']) ||
                                (!empty($menuItem['submenu']) &&
                                collect($menuItem['submenu'])->contains(fn($child) => request()->routeIs($child)));
                        @endphp

                        <a href="{{ route( $menuItem['route'] ) }}"
                            class="{{ $isActive ? 'text-blue-600 font-semibold' : 'text-gray-700' }} font-medium"
                        >
                            {{ $menuItem['name'] }}
                        </a>
                    @endforeach
                </nav>
                <div class="flex items-center space-x-4">
                    <button class="relative p-2 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-bell"></i>
                    </button>

                    <flux:dropdown position="top" align="start">
                        <flux:profile avatar="{{ $user->profile_picture }}" />
                            <flux:menu>
                                <flux:menu.radio.group>
                                    <div class="p-0 text-sm font-normal">
                                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                                <span
                                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                                >
                                                    {{ auth()->user()->initials() }}
                                                </span>
                                            </span>

                                            <div class="grid flex-1 text-start text-sm leading-tight">
                                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </flux:menu.radio.group>

                                <flux:menu.separator />

                                <flux:menu.radio.group>
                                    <flux:menu.item href="{{ route('settings', ['tab' => 'personal-information']) }}"   icon="cog" wire:navigate >{{ __('Settings') }}</flux:menu.item>
                                </flux:menu.radio.group>

                                <flux:menu.separator />

                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="cursor-pointer w-full">
                                        {{ __('Log Out') }}
                                    </flux:menu.item>
                                </form>
                            </flux:menu>
                    </flux:dropdown>
                </div>
            </div>
        </div>
    </header>
</div>
