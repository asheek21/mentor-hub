<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Profile Picture</h3>
    <div class="flex items-center space-x-6">
        <div class="relative">
            <img class="h-24 w-24 rounded-full object-cover border-4 border-gray-200"
                @if (empty($profilePicture)) src="https://ui-avatars.com/api/?name={{ $name }}"
                                @else
                                    src="{{ $profilePicture }}" @endif
                alt="Profile picture">
        </div>
        <div>
            <flux:input type="file" wire:model="profilePicture" label="Profile Picture" accept="image/*"
                class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg mb-2" />

            <p class="text-sm text-gray-500">JPG, PNG or GIF. Max size 5MB.</p>
            <p class="text-sm text-gray-500">Recommended: 400x400px</p>
        </div>
    </div>
    @error('profilePicture')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
