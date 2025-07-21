 <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
     <h3 class="text-lg font-semibold text-gray-900 mb-4">Availability This Week</h3>
     <div class="space-y-3">
        @foreach ($schedules as $weekDay => $schedule)
            <div class="flex justify-between items-center">
                <span class="text-gray-700">{{ $weekDay }}</span>
                @if(isset($schedule['enabled']) && $schedule['enabled'])
                    <span class="text-sm text-green-600 bg-green-100 px-2 py-1 rounded">9:00 AM - 5:00 PM</span>
                @else
                    <span class="text-sm text-red-600 bg-red-100 px-2 py-1 rounded">Unavailable</span>
                @endif
            </div>
        @endforeach
     </div>
 </div>
