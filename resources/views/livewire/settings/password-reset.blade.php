  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
      <h3 class="text-lg font-semibold text-gray-900 mb-6">Change Password</h3>

      <form class="space-y-6" wire:submit.prevent="updateSettingsPassword">
          <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
              <input type="password" wire:model="current_password"
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              @error('current_password')
                  <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
              <input type="password" wire:model="password"
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              @error('password')
                  <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
              <input type="password" wire:model="password_confirmation"
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          </div>

          <div class="flex justify-end">
              <flux:button class="cursor-pointer" type="submit" variant="primary" color="blue">
                  Save & Continue
              </flux:button>
          </div>
      </form>
  </div>
