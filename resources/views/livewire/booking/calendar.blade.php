@push('custom-css')
    <style>
        .calendar-day {
            background-color: white;
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .calendar-day:hover {
            background-color: #f3f4f6;
        }
        .calendar-day.available {
            background-color: #ecfdf5;
            color: #065f46;
        }
        .calendar-day.selected {
            background-color: #3b82f6;
            color: white;
        }
        .time-slot {
            transition: all 0.2s;
        }
        .time-slot:hover {
            background-color: #f3f4f6;
        }
        .time-slot.selected {
            background-color: #3b82f6;
            color: white;
        }
    </style>
@endpush
<div>
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Select Date</h3>
        <div class="bg-gray-50 rounded-lg p-4">
            <!-- Calendar Header -->
            <div class="flex items-center justify-between mb-4">
                <button
                    wire:click="action('previousMonth')"
                    @class([
                        'p-2 hover:bg-gray-200 rounded-lg cursor-pointer',
                        'opacity-0' => $currentMonthIndex == 0
                    ])
                >
                    <i class="fas fa-chevron-left text-gray-600"></i>
                </button>
                <h4 id="currentMonth" class="text-lg font-semibold text-gray-900">{{ $months[$currentMonthIndex]['month'] }} {{ $months[$currentMonthIndex]['year'] }}</h4>
                <button
                    wire:click="action('nextMonth')"
                    @class([
                        'p-2 hover:bg-gray-200 rounded-lg cursor-pointer',
                        'opacity-0' => $currentMonthIndex == 3
                    ])
                >
                    <i class="fas fa-chevron-right text-gray-600"></i>
                </button>
            </div>

            <!-- Calendar Days Header -->
            <div
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-4"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-x-0"
                x-transition:leave-end="opacity-0 -translate-x-4"
                x-cloak
            >
                <div class="grid grid-cols-7 gap-1 mb-2">
                    @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayLabel)
                        <div class="text-center text-sm font-medium text-gray-500 py-2">
                            {{ $dayLabel }}
                        </div>
                    @endforeach
                </div>

                <!-- Calendar Grid -->
                <div id="calendarGrid" class="calendar-grid grid grid-cols-7 gap-1 rounded-lg overflow-hidden">
                    @php
                        $days = $months[$currentMonthIndex]['days'];
                        $firstDayOfWeek = \Carbon\Carbon::parse($days[0]['date'])->dayOfWeek;
                    @endphp

                    @for ($i = 0; $i < $firstDayOfWeek; $i++)
                        <div class="calendar-day bg-transparent cursor-default"></div>
                    @endfor

                    {{-- Actual calendar days --}}
                    @foreach ($days as $key => $day)
                        @php
                            $classes = 'calendar-day';

                            if ($day['date'] == $selectedDate) {
                                $classes .= ' selected available cursor-pointer';
                            } elseif(($day['is_today'] && !$day['is_enabled'])) {
                                $classes .= ' text-gray-300 cursor-not-allowed ring-2 border-blue-500 border-dashed';
                            } elseif($day['is_past']) {
                                $classes .= ' text-gray-300 !cursor-not-allowed';
                            } else if($day['is_enabled']) {
                                $classes .= " available cursor-pointer" ;
                            } else {
                                $classes .= ' text-gray-400 !cursor-not-allowed';
                            }

                        @endphp

                        <div class="{{ $classes }}" wire:click.debounce.500ms="updateSelectedDate('{{ $key }}')">
                            {{ $day['date_number'] }}
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <!-- Time Slots Section -->
    <div class="mb-8" x-show="$wire.timeSlots">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Select Time</h3>
        <div id="timeSlots" class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-3">
            @foreach ($timeSlots as $key => $timeSlot)
                <button
                    wire:key="time-slot-{{ $key }}"
                    wire:click="setSelectedTimeSlot('{{ $key }}')"
                    @class([
                        "cursor-pointer time-slot px-4 py-3 border border-gray-300 rounded-lg text-sm font-medium hover:border-blue-500",
                        "selected" => $selectedTimeSlot == $timeSlot['slot_start_time']
                    ])
                >
                    {{ $timeSlot['slot_start_time'] }}
                </button>
            @endforeach
        </div>
        <p id="noTimeSlots" class="text-gray-500 text-center py-4">Please select a date to view available time
            slots.</p>
    </div>
</div>

