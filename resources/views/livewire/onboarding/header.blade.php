<div>
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-900">MentorHub</h1>
                </div>
                <div class="text-sm text-gray-500">
                    Step {{ $currentStep }} of {{ $totalStep }}
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <div class="flex items-center justify-between text-sm font-medium text-gray-500 mb-2">
                <span>Profile Setup</span>
                <span>{{ $percentageCompleted}} % Complete</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: {{ $percentageCompleted }}%"></div>
            </div>
        </div>

        <!-- Welcome Section -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Welcome to MentorHub! 🎉</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Let's set up your mentor profile so students can discover your expertise and book sessions with you.
            </p>
        </div>
    </div>
</div>
