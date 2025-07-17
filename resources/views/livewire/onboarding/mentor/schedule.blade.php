<div class="lg:col-span-2">
    <!-- Timezone -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Timezone Settings</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Your Timezone *</label>
                <select
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    {{-- <option>Pacific Standard Time (PST)</option>
                            <option>Mountain Standard Time (MST)</option>
                            <option>Central Standard Time (CST)</option>
                            <option>Eastern Standard Time (EST)</option>
                            <option>Greenwich Mean Time (GMT)</option>
                            <option>Central European Time (CET)</option> --}}
                    <option checked>India Standard Time (IST)</option>
                    {{-- <option>Japan Standard Time (JST)</option>
                            <option>Other...</option> --}}
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Time</label>
                <div class="px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-700">
                    <i class="fas fa-clock mr-2"></i>
                    <span id="current-time">{{ $indiaTimeNow }} IST</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Weekly Schedule -->
    <form wire:submit.prevent = "saveSchedule">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Weekly Availability</h3>
                {{-- <button class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                    <i class="fas fa-copy mr-1"></i>Copy to all days
                </button> --}}
            </div>


            <div class="space-y-4">
                @foreach ($weekDays as $weekDay)
                    <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                        <div class="w-20">
                            <label class="flex items-center">
                                <input wire:click.debounce = "toggleDay('{{ $weekDay }}')" type="checkbox"
                                    class="text-blue-600" />
                                <span class="ml-2 font-medium text-gray-900">{{ $weekDay }}</span>
                            </label>
                        </div>
                        @if (in_array($weekDay, $enabledDays))
                            <div class="flex-1 grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">From</label>
                                    <select
                                        {{-- wire:model="schedule.{{ $weekDay }}.from" --}}
                                        wire:change="scheduleChanged('{{ $weekDay }}', 'from', $event.target.value)"
                                        class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                                        <option value="9:00 AM">9:00 AM</option>
                                        <option value="10:00 AM">10:00 AM</option>
                                        <option value="11:00 AM">11:00 AM</option>
                                        <option value="12:00 PM">12:00 PM</option>
                                        <option value="1:00 PM">1:00 PM</option>
                                        <option value="2:00 PM">2:00 PM</option>
                                        <option value="3:00 PM">3:00 PM</option>
                                        <option value="4:00 PM">4:00 PM</option>
                                        <option value="5:00 PM">5:00 PM</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">To</label>
                                    <select
                                        {{-- wire:model="schedule.{{ $weekDay }}.to" --}}
                                        wire:change="scheduleChanged('{{ $weekDay }}', 'to', $event.target.value)"
                                        class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                                        <option value="1:00 PM">1:00 PM</option>
                                        <option value="2:00 PM">2:00 PM</option>
                                        <option value="3:00 PM">3:00 PM</option>
                                        <option value="4:00 PM">4:00 PM</option>
                                        <option value="5:00 PM" selected>5:00 PM</option>
                                        <option value="6:00 PM">6:00 PM</option>
                                        <option value="7:00 PM">7:00 PM</option>
                                        <option value="8:00 PM">8:00 PM</option>
                                        <option value="9:00 PM">9:00 PM</option>
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="flex-1 text-gray-500 text-sm text-center">
                                Not available
                            </div>
                        @endif

                    </div>
                @endforeach
            </div>

            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-600 mt-0.5 mr-3"></i>
                    <div>
                        <h4 class="text-sm font-medium text-blue-800">Availability Tips</h4>
                        <ul class="text-sm text-blue-700 mt-1 space-y-1">
                            <li>• Set consistent weekly hours to attract regular mentees</li>
                            <li>• You can block specific dates for holidays or vacations later</li>
                            <li>• Buffer time between sessions is automatically added</li>
                            <li>• Students can book up to 2 weeks in advance</li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>


        <!-- Booking Settings -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Booking Settings</h3>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Advance booking
                            window</label>
                        <select
                            wire:model="advance_booking_window"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @foreach ($advanceBookingWindows as $advanceBookingWindow)
                                <option value="{{ $advanceBookingWindow->value }}">{{ $advanceBookingWindow->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Maximum booking
                            window</label>
                        <select
                            wire:model="maximum_booking_window"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @foreach ($maximumBookingWindows as $maximumBookingWindow)
                                <option value="{{ $maximumBookingWindow->value }}">{{ $maximumBookingWindow->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Buffer time between
                            sessions</label>
                        <select
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option>No buffer</option>
                            <option>15 minutes</option>
                            <option selected>30 minutes</option>
                            <option>60 minutes</option>
                        </select>
                    </div> --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Daily session limit</label>
                        <select
                            wire:model="daily_session_limit"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="0">No limit</option>
                            <option value="1">1 session per day</option>
                            <option value="2">2 sessions per day</option>
                            <option value="3">3 sessions per day</option>
                            <option value="4">4 sessions per day</option>
                            <option value="5">5 sessions per day</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Automatic availability</label>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" class="text-blue-600" wire:model="send_notification">
                            <span class="ml-3 text-sm text-gray-700">Send me email notifications for new
                                bookings</span>
                        </label>
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
