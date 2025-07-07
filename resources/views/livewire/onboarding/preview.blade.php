 <div class="lg:col-span-1">
     <div class="sticky top-8">
         <!-- Preview Card -->
         <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
             <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile Preview</h3>
             <div class="text-center">
                 <img class="h-16 w-16 rounded-full mx-auto mb-3"
                     src="{{ $profilePicture }}" alt="Profile">
                 <h4 class="font-semibold text-gray-900">{{ ucfirst($user->full_name) }}</h4>
                 <p class="text-sm text-gray-600 mb-3">{{ $currentRole }}</p>
                 <div class="flex justify-center mb-3">
                     <div class="flex text-yellow-400 text-sm">
                         <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                         <i class="fas fa-star"></i>
                     </div>
                     <span class="text-xs text-gray-500 ml-1">New</span>
                 </div>
                 <div class="flex flex-wrap gap-1 justify-center mb-4">
                    @foreach ($specialization as $spcl)
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $spcl }}</span>
                    @endforeach
                 </div>

                @if ($user->user_role == App\Enums\UserRole::MENTOR)
                    @if(!empty($hourlyRate && $sessionDuration > 0))
                        <div class="text-lg font-semibold text-gray-900 mb-3">
                            <i class="fa fa-inr mx-[3px] text-[12px]" aria-hidden="true"></i>
                            {{ $hourlyRate }}/{{ $sessionDuration }} min
                        </div>
                    @endif


                    <flux:button class="cursor-no-drop" type="submit" variant="primary" color="blue" >
                        Book Session
                    </flux:button>

                @else

                    <div class="text-sm text-gray-600">
                        <p x-show="$wire.timeline">🎯 Goal: {{ $timeline }} </p>
                        <p x-show="$wire.learning_preference">💡 Style: {{ $learning_preference }}</p>
                        <p x-show="$wire.session_frequency">📅 {{ $session_frequency }} </p>
                    </div>
                @endif

             </div>
         </div>

         <!-- Help Section -->
         @if( $user->user_role == App\Enums\UserRole::MENTOR)
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="font-medium text-gray-900 mb-3">Need Help?</h4>
                <div class="space-y-3 text-sm text-gray-600">
                    <a href="#" class="flex items-center hover:text-blue-600">
                        <i class="fas fa-book mr-2"></i>
                        Mentor Guidelines
                    </a>
                    <a href="#" class="flex items-center hover:text-blue-600">
                        <i class="fas fa-video mr-2"></i>
                        Setup Tutorial
                    </a>
                    <a href="#" class="flex items-center hover:text-blue-600">
                        <i class="fas fa-life-ring mr-2"></i>
                        Contact Support
                    </a>
                </div>
            </div>
        @else
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h4 class="font-medium text-blue-900 mb-3">💡 Pro Tips</h4>
                <div class="space-y-2 text-sm text-blue-800">
                    <p>• Be specific about your goals to get better mentor matches</p>
                    <p>• You can update your preferences anytime</p>
                    <p>• Most mentees start with 1-2 sessions to find the right fit</p>
                </div>
            </div>
        @endif
     </div>
 </div>
