
 <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
     <div class="p-6">
         <div class="flex items-start justify-between mb-4">
             <div class="flex items-center space-x-3">
                 <img class="h-12 w-12 rounded-full" src="{{ $mentor->profile_picture }}" alt="Mentor">
                 <div>
                     <h3 class="font-semibold text-gray-900">{{ $mentor->full_name }}</h3>
                     <p class="text-sm text-gray-500">{{ $mentor->userProfile->current_role }}</p>
                 </div>
             </div>
             <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Available</span>
         </div>

         <div class="flex items-center mb-3">

             @php
                 $maxStars = 5;
             @endphp

             <div class="flex text-sm">
                 @for ($i = 1; $i <= $maxStars; $i++)
                     <i class="fas fa-star {{ $i <= $userRatingRounded ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                 @endfor
             </div>

             <span class="text-sm text-gray-500 ml-2">{{ $userRating }} ({{ $mentor->user_ratings_count }} reviews
                 )</span>
         </div>

         <p class="text-sm text-gray-600 mb-4 line-clamp-3 h-16 overflow-hidden" title="{!! $mentor->userProfile->bio !!}">
             {!! $mentor->userProfile->bio !!}
         </p>

         <div class="flex flex-wrap gap-1 mb-4">
            @foreach ($skills as $skill)
                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ \Str::title($skill) }}</span>
            @endforeach
         </div>

         <div class="flex items-center justify-between">
             <div class="text-lg font-semibold text-gray-900">{{ $hourlyRate }}/hr</div>
             <div class="flex space-x-2">
                 <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-3 py-1 rounded">View
                     Profile</button>
                 <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded">Book
                     Session</button>
             </div>
         </div>
     </div>
 </div>
