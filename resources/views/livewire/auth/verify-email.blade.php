<div class="bg-gray-50">
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-900">mentorLog</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Success State -->
            <div class="text-center">
                <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-envelope text-blue-600 text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Check your email</h2>
                <p class="text-gray-600 mb-8">
                    We've sent a verification link to<br>
                    <strong>{{ $user->email }}</strong>
                </p>
            </div>

            <!-- Verification Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                <div class="space-y-6">
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">What's next?</h3>
                        <div class="space-y-4 text-left">
                            <div class="flex items-start space-x-3">
                                <div
                                    class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-medium">
                                    1</div>
                                <p class="text-gray-600 text-sm">Check your email inbox (and spam folder)</p>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div
                                    class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-medium">
                                    2</div>
                                <p class="text-gray-600 text-sm">Click the verification link in the email</p>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div
                                    class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-medium">
                                    3</div>
                                <p class="text-gray-600 text-sm">Complete your profile setup</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-6">
                        <div class="space-y-4">
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-3">Didn't receive the email?</p>
                                <button wire:click="sendVerification" class="text-blue-600 hover:text-blue-700 font-medium text-sm cursor-pointer">
                                    Resend verification email
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Help Section -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="font-medium text-gray-900 mb-3">Having trouble?</h4>
                <div class="space-y-2 text-sm text-gray-600">
                    <p>• Check your spam or junk folder</p>
                    <p>• Make sure {{ $user->email }} is correct</p>
                    <p>• Add noreply@skillbridge.com to your contacts</p>
                </div>
                <div class="mt-4">
                     <flux:link class="text-sm cursor-pointer" wire:click="logout">
                        {{ __('Log out') }}  <i class="fas fa-arrow-right ml-1"></i>
                    </flux:link>

                </div>
            </div>
        </div>
    </div>
</div>
