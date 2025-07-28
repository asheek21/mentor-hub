<div class="bg-white rounded-lg shadow-sm border mb-8 p-6">
    <div class="flex items-start space-x-4">
        <img src="{{ $mentor->profile_picture }}"
            alt="Dr. Sarah Chen" class="w-16 h-16 rounded-full object-cover">
        <div class="flex-1">
            <h2 class="text-xl font-semibold text-gray-900">{{ $mentor->full_name }}</h2>
            <p class="text-gray-600">{{ $mentor->mentorProfile->current_role }}</p>
            <div class="flex items-center space-x-4 mt-2">
                <div class="flex items-center space-x-1">
                     @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star {{ $i < $roundedAverageRating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                    @endfor
                    <span class="text-gray-600">{{ $averageRating }} ({{ $mentor->user_ratings_count }} reviews)</span>
                </div>
                <div class="text-gray-600">
                    <i class="fas fa-clock mr-1"></i>
                    {{ $mentor->mentorProfile->session_duration }} min session
                </div>
                <div class="text-blue-600 font-semibold">
                    {{ rupeeFormatter($mentor->mentorProfile->hourly_rate) }}/session
                </div>
            </div>
        </div>
    </div>
</div>
