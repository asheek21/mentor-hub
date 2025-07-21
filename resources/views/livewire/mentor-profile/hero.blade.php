 <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-8">
     <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6">
         <img class="h-24 w-24 rounded-full" src="{{ $user->profile_picture }}"
             alt="{{ $user->full_name }}">
         <div class="flex-1">
             <div class="flex items-center space-x-3 mb-2">
                 <h1 class="text-3xl font-bold text-gray-900">{{ $user->full_name }}</h1>
                 <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">Available</span>
             </div>
             <p class="text-xl text-gray-600 mb-3">{{ $user->mentorProfile->current_role }}</p>
             <div class="flex items-center space-x-4 mb-4">
                 <div class="flex items-center">
                     <div class="flex text-yellow-400 text-lg">
                        @for($i = 0; $i < 5; $i++)
                            <i class="fas fa-star {{ $i < $roundedAverageRating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor
                     </div>
                     <span class="text-lg text-gray-600 ml-2">{{ $averageRating }} ({{ $user->user_ratings_count }} reviews)</span>
                 </div>
                 <div class="text-gray-500">•</div>
                 <div class="text-gray-600">0 sessions completed</div>
             </div>
             <div class="flex flex-wrap gap-2">
                @foreach ($mentorSkills as $mentorSkill)
                    <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">{{ $mentorSkill }}</span>
                @endforeach
             </div>
         </div>
     </div>
 </div>
