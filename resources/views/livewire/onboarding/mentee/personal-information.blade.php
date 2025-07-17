<div>
    <form class="space-y-6" wire:submit="storePersonalInformation">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Tell us about yourself</h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Status *</label>
                <select wire:model = "current_status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Select your current status</option>

                    @foreach ($menteeCurrentStatus as $currentStatus)
                        <option value="{{ $currentStatus->value }}">{{ $currentStatus->label() }}</option>
                    @endforeach

                </select>

                @error('current_status')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Field/Industry
                    (Optional)</label>
                <input type="text" wire:model="current_role"
                    wire:keydown.debounce="previewUpdates"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="e.g., Software Development, Marketing, Finance, Design">
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tell us about your background
                    and goals *</label>
                <textarea wire:model="bio"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    rows="4"
                    placeholder="Share your background, what you're currently working on, and what you hope to achieve through mentorship. This helps us match you with the right mentors."></textarea>
                <p class="text-sm text-gray-500 mt-1">This information helps mentors understand how they can
                    best help you.
                </p>

                @error('bio')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="flex justify-end">
            <flux:button class="cursor-pointer" type="submit" variant="primary" color="blue">
                Save & Continue
            </flux:button>
        </div>
    </form>
</div>
