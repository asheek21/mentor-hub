@push('custom-css')
    @vite(['resources/css/coming-soon.css'])
@endpush

<div>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-md w-full text-center">
            <!-- Coming Soon with Animation -->
            <div class="animate-fade-in-up">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 animate-pulse-slow">
                    Coming Soon
                </h1>

                <!-- Animated dots -->
                <div class="flex justify-center space-x-1 mb-12">
                    <span class="dot text-2xl font-bold">.</span>
                    <span class="dot text-2xl font-bold">.</span>
                    <span class="dot text-2xl font-bold">.</span>
                </div>
            </div>

            <!-- Progress Bar with Animation -->
            <div class="mb-12 animate-fade-in-up" style="animation-delay: 0.3s; animation-fill-mode: both;">
                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-3 rounded-full animate-progress shadow-sm"></div>
                </div>
                <div class="mt-3 text-sm text-gray-500 animate-fade-in-up" style="animation-delay: 2.5s; animation-fill-mode: both;">
                    Development in progress...
                </div>
            </div>

            <!-- Dashboard Button with Animation -->
            <div class="animate-fade-in-up animate-float" style="animation-delay: 0.6s; animation-fill-mode: both;">
                <button
                    x-on:click="window.location.href = '{{ route('dashboard') }}'"
                    class="cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium py-3 px-8 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg"
                >
                    <i class="fas fa-home mr-2"></i>
                    Go to Dashboard
                </button>
            </div>
        </div>
    </div>
</div>

@push('custom-script')
    @vite(['resources/js/coming-soon.js'])
@endpush
