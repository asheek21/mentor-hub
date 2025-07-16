<div>
    <form wire:submit.prevent="updatePricing">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Set Your Hourly Rate</h3>


                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Hourly Rate (INR) *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-lg">
                                        <i class="fa fa-inr mx-[3px] text-[15px]" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="number" wire:model.defer="hourly_rate" wire:keydown.debounce.250ms="previewUpdates"
                                    class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="85">
                            </div>
                            @error('hourly_rate')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <p class="text-sm text-gray-500 mt-1">
                                Recommended range: <i class="fa fa-inr mx-[3px] text-[12px]" aria-hidden="true"></i>50-250 per hour
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Session Duration</label>
                            <select wire:model.defer="session_duration" wire:click.debounce="previewUpdates"
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

        </div>

        <livewire:onboarding.mentor.account-status :user="$user"/>

        <div class="flex justify-end">
            <flux:button class="cursor-pointer" type="submit" variant="primary" color="blue">
                Save & Continue
            </flux:button>
        </div>
    </form>
</div>
