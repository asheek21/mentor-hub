<div id="personal-tab" class="tab-content">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Personal Information</h3>

        <livewire:profile-picture :user="$user" />

        <!-- Form Fields -->
        <form class="space-y-6" wire:submit.prevent="updatePersonalInformation">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name*</label>
                    <input type="text"
                        wire:model="first_name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >

                    @error('first_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text"
                        wire:model="last_name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >

                    @error('last_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <input type="email"
                    wire:model="email"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed"
                    readonly
                >
                <p class="text-sm text-gray-500 mt-1">Email address cannot be changed. Contact support if needed.</p>

                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Status*</label>
                <select
                    wire:model="current_status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @foreach ($currentStatuses as $currentStatus)
                        <option value="{{ $currentStatus->value }}">{{ $currentStatus->label() }}</option>
                    @endforeach
                </select>

                @error('current_status')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Field/Industry</label>
                <input type="text"
                    wire:model="current_role"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >

                @error('current_role')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">About Me*</label>
                <textarea
                    wire:model="bio"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    rows="4">
                </textarea>

                @error('bio')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <flux:button class="cursor-pointer" type="submit" variant="primary" color="blue">
                    Save & Continue
                </flux:button>
            </div>
        </form>
    </div>

    <!-- Change Password Section -->
    <livewire:settings.password-reset :user="$user"/>

    <!-- Delete Account Section -->
    {{-- <livewire:settings.delete-user-form /> --}}
</div>
