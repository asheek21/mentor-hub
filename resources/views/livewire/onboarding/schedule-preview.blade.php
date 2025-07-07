 <div class="lg:col-span-1">
     <div class="sticky top-8">
         <!-- Schedule Preview -->
         <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
             <h3 class="text-lg font-semibold text-gray-900 mb-4">This Week's Schedule</h3>
             <div class="space-y-3">
                 @foreach ($weekDays as $weekDay)
                     <div class="flex justify-between items-center">
                         <span class="text-sm text-gray-600">{{ $weekDay }}</span>
                         @if (isset($schedule[$weekDay]) && isset($schedule[$weekDay]['enabled']) && $schedule[$weekDay]['enabled'])
                             <span class="text-sm font-medium text-green-600">{{ $schedule[$weekDay]['from'] }} -
                                 {{ $schedule[$weekDay]['to'] }}</span>
                         @else
                             <span class="text-sm text-gray-400">Not available</span>
                         @endif
                     </div>
                 @endforeach
             </div>

             {{-- <div class="mt-4 p-3 bg-green-50 rounded-lg">
                 <div class="text-sm text-green-800">
                     <p class="font-medium">Weekly Capacity</p>
                     <p>20 hours available for mentoring</p>
                     <p>~20 sessions possible</p>
                 </div>
             </div> --}}
         </div>

         <!-- Calendar Integration -->
         {{-- <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
             <h3 class="text-lg font-semibold text-gray-900 mb-4">Calendar Integration</h3>
             <p class="text-sm text-gray-600 mb-4">Connect your calendar to avoid double bookings</p>

             <div class="space-y-3">
                 <button
                     class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50">
                     <i class="fab fa-google text-red-600 mr-2"></i>
                     Google Calendar
                 </button>
                 <button
                     class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50">
                     <i class="fab fa-microsoft text-blue-600 mr-2"></i>
                     Outlook Calendar
                 </button>
                 <button
                     class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50">
                     <i class="fab fa-apple text-gray-800 mr-2"></i>
                     Apple Calendar
                 </button>
             </div>

             <p class="text-xs text-gray-500 mt-3 text-center">
                 Optional: We'll check for conflicts automatically
             </p>
         </div> --}}

         <!-- Tips -->
         <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
             <h4 class="font-medium text-blue-900 mb-3">📅 Scheduling Tips</h4>
             <div class="space-y-2 text-sm text-blue-800">
                 <p>• Start with fewer hours and increase based on demand</p>
                 <p>• Peak times are usually evenings and weekends</p>
                 <p>• Consider different time zones if mentoring globally</p>
             </div>
         </div>
     </div>
 </div>
