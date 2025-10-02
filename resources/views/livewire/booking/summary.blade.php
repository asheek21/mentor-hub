<div class="bg-gray-50 rounded-lg p-4 mb-6">
    <h4 class="font-semibold text-gray-900 mb-3">Booking Summary</h4>
    <div class="space-y-2 text-sm">
        <div class="flex justify-between">
            <span class="text-gray-600">Mentor:</span>
            <span class="font-medium">{{ $mentor->full_name }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Date:</span>
            <span id="selectedDate" class="font-medium">{{ empty($selectedDate) ? 'Please select a date' : $selectedDate }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Time:</span>
            <span id="selectedTime" class="font-medium">{{ empty($selectedTimeSlot) ? 'Please select a time' : $selectedTimeSlot }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Duration:</span>
            <span class="font-medium">{{ $sessionDuration }} minutes</span>
        </div>
        <hr class="my-3">
        <div class="flex justify-between font-semibold">
            <span>Total:</span>
            <span>{{ rupeeFormatter($hourlyRate) }}</span>
        </div>
    </div>
</div>
