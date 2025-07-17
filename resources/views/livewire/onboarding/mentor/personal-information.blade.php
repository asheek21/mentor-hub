<div>
    <form class="space-y-6" wire:submit.prevent="storeProfessionalDetails">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Professional Information</h3>

            <flux:input type="text" wire:model="form.current_role" wire:keydown.debounce="previewUpdates"
                placeholder="e.g., Senior Software Engineer, UX Designer, Product Manager" label="Current Role/Title *" />

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Professional Bio *</label>
                <textarea wire:model.defer="form.bio"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    rows="4"
                    placeholder="Tell potential mentees about your background, expertise, and what you're passionate about teaching. This will help them understand how you can help them achieve their goals."></textarea>

                @error('form.bio')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                <p class="text-sm text-gray-500 mt-1">This will be visible to potential mentees. Be
                    authentic and highlight your unique expertise.</p>

            </div>

        </div>

        <!-- Work Experience -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Work Experience</h3>
                <button
                    wire:click="addExperience"
                    type="button"
                    id="addExperience"
                    class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center cursor-pointer">
                    <i class="fas fa-plus mr-1"></i>Add Experience
                </button>
            </div>

            <div id="experienceContainer" class="space-y-6">
                <!-- Experience Entry 1 -->
                @foreach($form->experiences as $index => $experience)
                    <div class="experience-entry border border-gray-200 rounded-lg p-6 relative">
                        <button type="button"
                            wire:click="removeExperience({{ $index }})"
                            class="remove-experience absolute top-4 right-4 text-gray-400 hover:text-red-500 text-sm">
                            <i class="fas fa-times"></i>
                        </button>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Job Title *</label>
                                <input type="text"
                                    wire:model="form.experiences.{{ $index }}.job_title"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="e.g., Senior Software Engineer">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Company *</label>
                                <input type="text"
                                    wire:model="form.experiences.{{ $index }}.company_name"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="e.g., Google" >
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Start Date *</label>
                                <input type="month"
                                    wire:model="form.experiences.{{ $index }}.start_date"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                                <input type="month"
                                    wire:model="form.experiences.{{ $index }}.end_date"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent end-date"
                                >
                            </div>
                            <div class="flex items-end">
                                <label class="flex items-center">
                                    <input
                                        wire:model="form.experiences.{{ $index }}.current_position"
                                        type="checkbox" class="current-position text-blue-600"
                                    >
                                    <span class="ml-2 text-sm text-gray-700">Current Position</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
                            <textarea
                                wire:model="form.experiences.{{ $index }}.description"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                rows="3" placeholder="Describe your role, responsibilities, and achievements...">

                            </textarea>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-600 mt-0.5 mr-3"></i>
                    <div>
                        <h4 class="text-sm font-medium text-blue-800">Experience Tips</h4>
                        <ul class="text-sm text-blue-700 mt-1 space-y-1">
                            <li>• Add your most recent and relevant positions first</li>
                            <li>• Include achievements and impact in your descriptions</li>
                            <li>• Highlight experiences that relate to your mentoring expertise</li>
                            <li>• This information helps mentees understand your background</li>
                        </ul>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                @php
                    $filteredErrors = collect($errors->getMessages())
                        ->reject(function ($_, $key) {
                            return in_array($key, ['form.bio', 'form.current_role']);
                        })
                        ->flatten();
                @endphp

                @if ($filteredErrors->isNotEmpty())
                    <ul class="text-sm text-red-600 mt-2 space-y-1">
                        @foreach ($filteredErrors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            @endif

        </div>

        <div class="flex justify-end">
            <flux:button class="cursor-pointer" type="submit" variant="primary" color="blue">
                Save & Continue
            </flux:button>
        </div>
    </form>
</div>
