<div class="lg:col-span-1">
    <div class="sticky top-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <nav class="space-y-2">
                @foreach ($sideBarMenus as $sideBarMenu)
                    <button
                        wire:click="changeTab('{{ $sideBarMenu['tab'] }}')"
                        @class([
                            'cursor-pointer w-full text-left px-3 py-2 text-sm font-medium nav-item',
                            'text-blue-600 bg-blue-50 rounded-lg border-l-4 border-blue-600' => $sideBarMenu['tab'] == $tab,
                            'text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors' => $sideBarMenu['tab'] != $tab,
                        ])
                    >
                        <i class="{{ $sideBarMenu['icon'] }}"></i>
                        {{ $sideBarMenu['title'] }}
                    </button>
                @endforeach
            </nav>
        </div>
    </div>
</div>
