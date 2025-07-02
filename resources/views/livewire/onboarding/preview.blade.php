 <div class="lg:col-span-1">
     <div class="sticky top-8">
         <!-- Preview Card -->
         <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
             <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile Preview</h3>
             <div class="text-center">
                 <img class="h-16 w-16 rounded-full mx-auto mb-3"
                     src="{{ $user->profile_picture }}" alt="Profile">
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
                 @if(!empty($hourlyRate && $sessionDuration > 0))
                    <div class="text-lg font-semibold text-gray-900 mb-3">
                        <i class="fa fa-inr mx-[3px] text-[12px]" aria-hidden="true"></i>
                        {{ $hourlyRate }}/{{ $sessionDuration }} min
                    </div>
                @endif
                <flux:button class="cursor-no-drop" type="submit" variant="primary" color="blue" >
                    Book Session
                </flux:button>
             </div>
         </div>

         <!-- Help Section -->
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
     </div>
 </div>
