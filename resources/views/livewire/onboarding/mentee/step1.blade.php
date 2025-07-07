<div>
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Welcome to MentorHub! 🎉</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Let's set up your mentor profile so students can discover your expertise and book sessions with you.
        </p>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <livewire:profile-picture :user="$user" />

                <form class="space-y-6" wire:submit="storeProfileDetails">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Tell us about yourself</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Status *</label>
                            <select wire:model = "form.current_status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option>Select your current status</option>
                                <option option="high_school_student">Student (High School)</option>
                                <option option="university_student">Student (University/College)</option>
                                <option option="graduate">Recent Graduate</option>
                                <option option="early_career_professional">Early Career Professional (0-2 years)
                                </option>
                                <option option="mid_level_professional">Mid-level Professional (3-7 years)</option>
                                <option option="senior_professional">Senior Professional (8+ years)</option>
                                <option option="career_changer">Career Changer</option>
                                <option option="entrepreneur">Entrepreneur</option>
                                <option option="freelancer">Freelancer</option>
                                <option option="between_jobs">Between Jobs</option>
                                <option option="other">Other</option>
                            </select>

                            @error('form.current_status')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Field/Industry
                                (Optional)</label>
                            <input type="text" wire:model="from.current_role"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="e.g., Software Development, Marketing, Finance, Design">
                        </div>

                        <div class="mt-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tell us about your background
                                and goals *</label>
                            <textarea wire:model="form.bio"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                rows="4"
                                placeholder="Share your background, what you're currently working on, and what you hope to achieve through mentorship. This helps us match you with the right mentors."></textarea>
                            <p class="text-sm text-gray-500 mt-1">This information helps mentors understand how they can
                                best help you.
                            </p>

                             @error('form.bio')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">What do you want to learn?</h3>
                        <p class="text-gray-600 mb-6">Select the areas you're interested in learning or improving. You
                            can choose multiple areas.</p>

                        <div class="space-y-6">
                            <div>
                                <h4 class="font-medium text-gray-900 mb-3">Programming & Development</h4>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                    @foreach (['javascript', 'react', 'node js', 'python', 'java', 'typescript','machine learning', 'data science'] as $programming)
                                        <label
                                            class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                            <input wire:model="form.specialization.programming" type="checkbox"
                                                name="skills" value="{{ $programming }}" class="text-blue-600"
                                                wire:click.debounce="previewUpdates" />
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
                                            <input wire:model="form.specialization.design" type="checkbox"
                                                name="skills" value="{{ $design }}" class="text-blue-600"
                                                wire:click.debounce="previewUpdates" />
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
                                            <input wire:model="form.specialization.career" type="checkbox"
                                                name="skills" value="{{ $career }}" class="text-blue-600"
                                                wire:click.debounce="previewUpdates" />
                                            <span class="ml-3 text-sm">{{ $career }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Other Skills
                                    (Optional)</label>
                                <input type="text" wire:model="form.specialization.others" x-data
                                    x-on:input="$el.value = $el.value
                                        .replace(/\s*,\s*/g, ',')
                                        .replace(/,+/g, ',')"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Add custom skills separated by commas"
                                    wire:keydown.debounce="previewUpdates" />
                            </div>

                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Learning Preferences</h3>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">What's your preferred learning style? *</label>
                                <div class="space-y-3">
                                    @foreach ($learningPreferences as $learningPreference)
                                        <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                            <input
                                                type="radio"
                                                name="learning-style"
                                                value="{{ $learningPreference->value }}"
                                                class="text-blue-600"
                                                wire:model="form.learning_preference"
                                                wire:click.debounce="previewUpdates"
                                            />
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
                                    @foreach($SessionFrequencies as $SessionFrequency)
                                        <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                            <input
                                                type="radio"
                                                name="frequency"
                                                value="{{ $SessionFrequency->value }}"
                                                class="text-blue-600"
                                                wire:model="form.session_frequency"
                                                wire:click.debounce="previewUpdates"
                                            />
                                            <span class="ml-3 text-sm">{{ $SessionFrequency->label() }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-6">Your Learning Goals</h3>

                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">What's your main goal? *</label>
                                        <textarea
                                            wire:model="form.learning_goal"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            rows="3"
                                            placeholder="e.g., Learn React to build a portfolio project, transition to a UX design career, improve leadership skills for a promotion, etc."
                                        ></textarea>

                                         @error('form.learning_goal')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-3">What's your timeline? *</label>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                            @foreach ($MenteeTimelines as $MenteeTimeline)
                                                <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                                    <input
                                                    wire:model="form.timeline" wire:click.debounce="previewUpdates"
                                                     type="radio" name="timeline" value="{{ $MenteeTimeline->value }}" class="text-blue-600">
                                                    <span class="ml-3 text-sm">{{ $MenteeTimeline->label() }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Any specific challenges you're facing? (Optional)</label>
                                        <textarea wire:model="form.challenges"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            rows="3"
                                            placeholder="Share any specific obstacles, knowledge gaps, or areas where you're stuck. This helps us match you with mentors who have experience overcoming similar challenges."
                                        ></textarea>
                                    </div>
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

            <livewire:onboarding.preview :user="$user" />
        </div>
    </div>
</div>
