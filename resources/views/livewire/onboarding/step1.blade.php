<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Profile Picture -->
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

            <form class="space-y-6" wire:submit="storeProfileDetails">

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Professional Information</h3>

                    <flux:input type="text"
                        wire:model="form.current_role"
                        wire:keydown.debounce="previewUpdates"
                        placeholder="e.g., Senior Software Engineer, UX Designer, Product Manager"
                        label="Current Role/Title *" />

                    <div class="mt-2">
                        <flux:input type="text" wire:model.defer="form.company"
                            placeholder="e.g., Google, Microsoft, Freelance" label="Company *" />
                    </div>

                    <div class="mt-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Years of Experience *</label>
                        <select wire:model.defer="form.years_of_experience"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option>Select experience level</option>
                            @foreach ($experienceLevels as $experienceLevel)
                                <option value="{{ $experienceLevel->value }}">{{ $experienceLevel->label() }}</option>
                            @endforeach
                        </select>
                         @error('form.years_of_experience')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

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

                <!-- Specializations -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Your Specializations</h3>
                    <p class="text-gray-600 mb-6">Select the areas where you can provide mentorship. You can choose
                        multiple specializations.</p>

                    <!-- Tech Categories -->
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-medium text-gray-900 mb-3">Programming & Development</h4>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach (['javascript', 'react', 'node js','python','java','typescript'] as $programming)
                                    <label
                                        class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input
                                            wire:model.defer="form.specialization.programming"
                                            type="checkbox" name="skills" value="{{ $programming }}" class="text-blue-600"
                                            wire:keydown.debounce="previewUpdates"
                                        />
                                        <span class="ml-3 text-sm">{{  ucfirst($programming) }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <h4 class="font-medium text-gray-900 mb-3">Design & User Experience</h4>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach (['ux design', 'figma', 'Prototyping','ui design'] as $design)
                                    <label
                                        class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input
                                            wire:model="form.specialization.design"
                                            type="checkbox" name="skills" value="{{ $design }}" class="text-blue-600"
                                            wire:keydown.debounce="previewUpdates"
                                        />
                                        <span class="ml-3 text-sm">{{  ucfirst($design) }}</span>
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
                                        <input
                                            wire:model="form.specialization.career"
                                            type="checkbox" name="skills" value="{{ $career }}"
                                            class="text-blue-600"
                                            wire:click.debounce="previewUpdates"
                                        />
                                        <span class="ml-3 text-sm">{{ $career }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Other Skills (Optional)</label>
                            <input type="text"
                                wire:model="form.specialization.others"
                                x-data
                                x-on:input="$el.value = $el.value
                                    .replace(/\s*,\s*/g, ',')
                                    .replace(/,+/g, ',')"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Add custom skills separated by commas"
                                wire:keydown.debounce="previewUpdates"
                            />
                        </div>
                    </div>

                    @error('form.specialization')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Pricing -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Set Your Hourly Rate</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Hourly Rate (INR) *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-lg">
                                        <i class="fa fa-inr mx-[3px] text-[15px]" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="number"
                                    wire:model.defer="form.hourly_rate"
                                    wire:keydown.debounce.250ms="previewUpdates"
                                    class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="85">
                            </div>
                             @error('form.hourly_rate')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <p class="text-sm text-gray-500 mt-1">
                               Recommended range: <i class="fa fa-inr mx-[3px] text-[12px]" aria-hidden="true"></i>50-250 per hour
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Session Duration</label>
                            <select
                                wire:model.defer="form.session_duration"
                                wire:click.debounce="previewUpdates"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="60">60 minutes (Recommended)</option>
                                <option value="45">45 minutes</option>
                                <option value="90">90 minutes</option>
                                <option value="120">120 minutes</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-600 mt-0.5 mr-3"></i>
                            <div>
                                <h4 class="text-sm font-medium text-blue-800">Pricing Tips</h4>
                                <ul class="text-sm text-blue-700 mt-1 space-y-1">
                                    <li>• Research similar mentors in your field for competitive pricing</li>
                                    <li>• You can adjust your rates anytime based on demand</li>
                                    <li>• SkillBridge takes a 10% platform fee from each session</li>
                                </ul>
                            </div>
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

        <!-- Sidebar -->
       <livewire:onboarding.preview :user="$user"/>
    </div>
</div>
