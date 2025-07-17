<div>
    <form class="space-y-6" wire:submit="updatePreference">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Learning Preferences</h3>

            <div class="space-y-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">What's your main goal? *</label>
                    <textarea wire:model="form.learning_goal"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        rows="3"
                        placeholder="e.g., Learn React to build a portfolio project, transition to a UX design career, improve leadership skills for a promotion, etc."></textarea>

                    @error('form.learning_goal')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">What's your preferred learning style?
                        *</label>
                    <div class="space-y-3">
                        @foreach ($learningPreferences as $learningPreference)
                            <label
                                class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="learning-style" value="{{ $learningPreference->value }}"
                                    class="text-blue-600" wire:model="form.learning_preference"
                                    wire:click.debounce="previewUpdates" />
                                <div class="ml-3">
                                    <div class="font-medium text-gray-900">{{ $learningPreference->label() }}</div>
                                    <div class="text-sm text-gray-600">{{ $learningPreference->description() }}</div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Preferred session frequency *</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach ($SessionFrequencies as $SessionFrequency)
                            <label
                                class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="frequency" value="{{ $SessionFrequency->value }}"
                                    class="text-blue-600" wire:model="form.session_frequency"
                                    wire:click.debounce="previewUpdates" />
                                <span class="ml-3 text-sm">{{ $SessionFrequency->label() }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Any specific challenges you're
                        facing? (Optional)</label>
                    <textarea wire:model="form.challenges"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        rows="3"
                        placeholder="Share any specific obstacles, knowledge gaps, or areas where you're stuck. This helps us match you with mentors who have experience overcoming similar challenges."></textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <flux:button class="cursor-pointer" type="submit" variant="primary" color="blue">
                Save & Continue
            </flux:button>
        </div>
    </form>
</div>
