<div id="loginModal"
    x-show="!$wire.hidden"
    x-init="$watch('$wire.hidden', value => document.body.style.overflow = value ? 'auto' : 'hidden')"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50"
    @click="$wire.hide()"
>
    <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4" @click.stop>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Welcome Back</h2>
            <button class="text-gray-500 hover:text-gray-700 cursor-pointer" @click="$wire.hide()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form class="space-y-4" wire:submit.prevent="login">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email"
                    wire:model.defer="email"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="your@email.com"
                >
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password"
                    wire:model.defer="password"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" class="text-blue-600">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
                <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg cursor-pointer">
                Sign In
            </button>
        </form>
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Don't have an account?
                <a href="javascript:void(0);" wire:click="newUser" class="text-blue-600 hover:underline font-medium">Sign up free</a>
            </p>
        </div>
    </div>
</div>
