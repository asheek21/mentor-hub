<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Stats</h3>
    <div class="space-y-3">
        <div class="flex justify-between">
            <span class="text-gray-600">Response Time</span>
            <span class="text-gray-900 font-medium">
                < 2 hours</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Languages</span>
            <span class="text-gray-900 font-medium">English, Spanish</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Timezone</span>
            <span class="text-gray-900 font-medium">IST (UTC +05:30)</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Member Since</span>
            <span class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($user->created_at)->format('Y') }}</span>
        </div>
    </div>
</div>
