<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Your Specializations</h3>
    <p class="text-gray-600 mb-6">Select the areas where you can provide mentorship. You can choose
        multiple specializations.</p>

    <!-- Tech Categories -->
    <form wire:submit.prevent="updateSpecialization">
        <div class="space-y-6">
            <div>
                <h4 class="font-medium text-gray-900 mb-3">Programming & Development</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach (['javascript', 'react', 'node js', 'python', 'java', 'typescript'] as $programming)
                        <label
                            class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input wire:model.defer="specialization.programming" type="checkbox" name="skills"
                                value="{{ $programming }}" class="text-blue-600" wire:click.debounce="previewUpdates" />
                            <span class="ml-3 text-sm">{{ ucfirst($programming) }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div>
                <h4 class="font-medium text-gray-900 mb-3">Design & User Experience</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach (['ux design', 'figma', 'Prototyping', 'ui design'] as $design)
                        <label
                            class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input wire:model="specialization.design" type="checkbox" name="skills"
                                value="{{ $design }}" class="text-blue-600" wire:click.debounce="previewUpdates" />
                            <span class="ml-3 text-sm">{{ ucfirst($design) }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div>
                <h4 class="font-medium text-gray-900 mb-3">Career & Business</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach (['career coaching', 'leadership', 'product management'] as $career)
                        <label
                            class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input wire:model="specialization.career" type="checkbox" name="skills"
                                value="{{ $career }}" class="text-blue-600" wire:click.debounce="previewUpdates" />
                            <span class="ml-3 text-sm">{{ $career }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Other Skills
                    (Optional)</label>
                <input type="text" wire:model="specialization.others" x-data
                    x-on:input="$el.value = $el.value
                                            .replace(/\s*,\s*/g, ',')
                                            .replace(/,+/g, ',')"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Add custom skills separated by commas" wire:keydown.debounce="previewUpdates" />
            </div>

            <div class="flex justify-end">
                <flux:button class="cursor-pointer" type="submit" variant="primary" color="blue">
                    Save & Continue
                </flux:button>
            </div>
        </div>


    </form>

    @error('specialization')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
