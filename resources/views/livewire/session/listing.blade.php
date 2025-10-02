<div>

    @if (!isset($sessions[0]))
        <div class="text-center text-gray-600">No sessions found</div>
    @endif

    @foreach ($sessions as $session)
        <div
            @php
                $pending = $session['status'] == \App\Enums\BookingStatus::PENDING || $session['status'] == \App\Enums\BookingStatus::CONFIRMED ;
                $completed = $session['status'] == \App\Enums\BookingStatus::COMPLETED;
                $cancelled = $session['status'] == \App\Enums\BookingStatus::CANCELLED || $session['status'] == \App\Enums\BookingStatus::AUTOCANCELLED;
            @endphp

            @class([
                'border border-blue-200 bg-blue-50 rounded-lg p-6 mb-4' => $pending,
                'border border-gray-200 rounded-lg p-6 mb-4' => $completed,
                'border border-red-200 bg-red-50 rounded-lg p-6 mb-4' => $cancelled
            ])>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="flex items-start space-x-4 mb-4 md:mb-0">
                    <img class="h-12 w-12 rounded-full" src="{{ $session->mentor->profile_picture }}"
                        alt="{{ $session->mentor->full_name }}">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $session->meeting_heading }}</h3>
                        <p class="text-gray-600">with {{ $session->mentor->full_name }}</p>
                        <div class="flex items-center mt-2 space-x-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $session->schedule->format('M d, Y') }}
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-clock mr-1"></i>
                                {{ $session->schedule->format('h:i A') }} IST
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">{{ $session->status->label() }}</span>
                        </div>

                        @if ($session->status == \App\Enums\BookingStatus::COMPLETED)
                            <div class="flex items-center mt-2">
                                <span class="text-sm text-gray-500 mr-2">Your Rating:</span>
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($pending)
                    <div class="flex space-x-3">
                        <button class="bg-white hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg border border-gray-300">
                            <i class="fas fa-message mr-2"></i>Message
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            <i class="fas fa-video mr-2"></i>Join Session
                        </button>
                    </div>
                @elseif ($completed)
                    <div class="flex space-x-3">
                        <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">
                            <i class="fas fa-download mr-2"></i>Download Notes
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            <i class="fas fa-calendar-plus mr-2"></i>Book Again
                        </button>
                    </div>
                @elseif ($cancelled)
                    <div class="flex space-x-3">
                        <button class="bg-white hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg border border-gray-300">
                            <i class="fas fa-undo mr-2"></i>Reschedule
                        </button>
                    </div>
                @endif
            </div>

            @if ($pending)
                 @if(!empty($session->meeting_notes))
                    <div class="mt-4 p-4 bg-white rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-2">Session Notes</h4>
                        <p class="text-sm text-gray-600">{{ $session->meeting_notes }}</p>
                    </div>
                @endif
            @elseif ($completed)
                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-medium text-gray-900 mb-2">Session Summary</h4>
                    <p class="text-sm text-gray-600 mb-2">Discussed career transition strategies, reviewed resume, and created a 90-day action plan for job searching in tech.</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-paperclip mr-1"></i>
                        <span>2 files attached: Resume_v2.pdf, Action_Plan.pdf</span>
                    </div>
                </div>
            @elseif ($cancelled)
                <div class="mt-4 p-4 bg-white rounded-lg">
                    <h4 class="font-medium text-gray-900 mb-2">Cancellation Reason</h4>
                    <p class="text-sm text-gray-600">{{ $session->cancellation_reason }}.</p>
                </div>
            @endif

        </div>
    @endforeach


    @if ($sessions->hasPages())
        {{ $sessions->links() }}
    @endif
</div>
