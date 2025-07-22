<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
    <div class="text-center mb-6">
        <div class="text-4xl font-bold text-gray-900 mb-2">{{ rupeeFormatter($mentor->mentorProfile->hourly_rate) }}</div>
        <p class="text-gray-600">per {{ $mentor->mentorProfile->session_duration }}/min session</p>
    </div>

    <div class="space-y-4 mb-6">
        <div class="flex items-center space-x-3">
            <i class="fas fa-video text-blue-600"></i>
            <span class="text-gray-700">1-on-1 video sessions</span>
        </div>
        {{-- <div class="flex items-center space-x-3">
            <i class="fas fa-code text-blue-600"></i>
            <span class="text-gray-700">Code review & debugging</span>
        </div> --}}
        <div class="flex items-center space-x-3">
            <i class="fas fa-book text-blue-600"></i>
            <span class="text-gray-700">Learning resources included</span>
        </div>
        <div class="flex items-center space-x-3">
            <i class="fas fa-message text-blue-600"></i>
            <span class="text-gray-700">Follow-up support</span>
        </div>
    </div>

    <div>
        <button
            wire:click="createCheckoutSession"
            class="cursor-pointer w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg mb-3 transition-colors">
            Book a Session
        </button>
    </div>

    <button
        class="cursor-pointer w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-lg transition-colors">
        Send Message
    </button>
</div>
