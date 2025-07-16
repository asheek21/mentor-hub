<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Account Status</h3>
    <p class="text-gray-600 mb-6">Choose when you\'d like to start receiving booking requests from mentees.</p>

    <div class="space-y-4">
        <label
            class="flex items-start p-4 border-2 border-green-200 bg-green-50 rounded-lg cursor-pointer hover:bg-green-100 transition-colors">
            <input type="radio" name="account-status" value="1" class="text-green-600 mt-1"
                wire:model.live.debounce.500ms="accountStatus"
            >
            <div class="ml-3 flex-1">
                <div class="flex items-center">
                    <div class="font-medium text-gray-900">Make my account active immediately</div>
                    <span class="ml-2 bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Recommended</span>
                </div>
                <div class="text-sm text-gray-600 mt-1">
                    Your profile will be visible to mentees and they can book sessions with you right away.
                </div>
            </div>
        </label>

        <label
            class="flex items-start p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
            <input type="radio" name="account-status" value="0" class="text-blue-600 mt-1"
                wire:model.live.debounce.500ms="accountStatus"
            >
            <div class="ml-3 flex-1">
                <div class="font-medium text-gray-900">Start as inactive</div>
                <div class="text-sm text-gray-600 mt-1">
                    Your profile will be hidden from mentees. You can activate it later from your dashboard.
                </div>
            </div>
        </label>
    </div>

    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-600 mt-0.5 mr-3"></i>
            <div>
                <h4 class="text-sm font-medium text-blue-800">Account Status Information</h4>
                <ul class="text-sm text-blue-700 mt-1 space-y-1">
                    <li>• <strong>Active:</strong> Your profile appears in search results and mentees can book sessions
                        immediately</li>
                    <li>• <strong>Inactive:</strong> Your profile is hidden and you won\'t receive booking requests</li>
                    <li>• You can change your status anytime from your mentor dashboard</li>
                    <li>• We recommend starting active to begin earning and building your reputation</li>
                    <li>• If you need time to prepare, you can start inactive and activate when ready</li>
                </ul>
            </div>
        </div>
    </div>
</div>
