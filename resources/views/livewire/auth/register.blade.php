<div id="signupModal" x-show="!$wire.hidden" x-transition
    class="fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50" @click="$wire.hide()">
    <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4" @click.stop>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Join MentorHub</h2>
            <button class="text-gray-500 hover:text-gray-700 cursor-pointer" @click="$wire.hide()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form wire:submit.prevent="register" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" wire:model.defer="first_name"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent border-gray-300 @error('first_name') border-red-500 @enderror">
                    @error('first_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" wire:model.defer="last_name"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent border-gray-300 @error('last_name') border-red-500 @enderror">
                    @error('last_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" wire:model.defer="email" placeholder="your@email.com"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent border-gray-300 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" wire:model.defer="password"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent border-gray-300 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password Confirmation</label>
                <input type="password" wire:model.defer="password_confirmation"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent border-gray-300 @error('password') border-red-500 @enderror">
                @error('password_confirmation')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">I want to:</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio" wire:model.defer="user_role" name="user_role" value="{{ \App\Enums\UserRole::MENTEE->value }}"
                            class="text-blue-600" checked>
                        <span class="ml-2 text-sm text-gray-700">Learn from mentors</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" wire:model.defer="user_role" name="user_role" value="{{ \App\Enums\UserRole::MENTOR->value }}"
                            class="text-blue-600">
                        <span class="ml-2 text-sm text-gray-700">Become a mentor</span>
                    </label>
                </div>
                @error('role')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg cursor-pointer">
                Create Account
            </button>
        </form>

        <div class="mt-6 text-center cursor-pointer">
            <p class="text-sm text-gray-600">
                Already have an account?
                <a href="javascript:void(0);" wire:click="existingUser" class="text-blue-600 hover:underline font-medium">Sign in</a>
            </p>
        </div>
    </div>
</div>
