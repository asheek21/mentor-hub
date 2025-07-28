@push('custom-css')
    <style>
        .loader-large {
            border: 3px solid #e5e7eb;
            border-top: 3px solid #3b82f6;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            animation: spin 1s linear infinite;
        }
        .loader-small {
            border: 2px solid #ffffff;
            border-top: 2px solid #3b82f6;
            border-radius: 50%;
            width: 12px;
            height: 12px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .overlay {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .scale-in {
            animation: scaleIn 0.3s ease-in-out;
        }
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
@endpush

<div class="fixed inset-0 bg-black bg-opacity-50 overlay flex items-center justify-center z-50 fade-in">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 scale-in">
        <!-- Payment Confirmation Content -->
        <div id="paymentConfirmationContent" class="p-8">
            <div class="text-center">
                <!-- Loading Icon -->
                <div class="mb-6">
                    <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <div class="loader-large"></div>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Confirming Payment</h2>
                    <p class="text-gray-600 text-sm mb-8">Please wait while we validate your payment with our secure
                        payment processor...</p>
                </div>

                <!-- Payment Summary -->
                <div class="bg-gray-50 rounded-lg p-4 mb-8">
                    <div class="flex justify-between items-center">
                        <div class="text-left">
                            <p class="font-medium text-gray-900" id="mentorName">Session with Dr. Sarah Chen</p>
                            <p class="text-sm text-gray-600" id="sessionDateTime">Jan 15, 2025 at 2:00 PM</p>
                        </div>
                        <span class="font-semibold text-lg text-gray-900" id="sessionAmount">$150.00</span>
                    </div>
                </div>

                <!-- Progress Steps -->
                <div class="space-y-4 text-left mb-8">
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Payment Submitted</p>
                            <p class="text-xs text-gray-500">Your payment has been successfully processed</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4" id="bankValidationStep">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <div class="loader-small"></div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Bank Validation</p>
                            <p class="text-xs text-gray-500">Validating payment with your bank...</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4" id="bookingConfirmationStep">
                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-calendar text-gray-500 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500">Booking Confirmation</p>
                            <p class="text-xs text-gray-400">Creating your session booking...</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4" id="emailNotificationStep">
                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-gray-500 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-500">Email Confirmation</p>
                            <p class="text-xs text-gray-400">Sending confirmation details...</p>
                        </div>
                    </div>
                </div>

                <!-- Status Message -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                        <div class="text-left">
                            <p class="text-sm font-medium text-blue-800">Processing Payment</p>
                            <p class="text-xs text-blue-600 mt-1">This usually takes 10-30 seconds. Please don't close
                                this window until the process is complete.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success State (Hidden by default) -->
        <div id="paymentSuccessContent" class="p-8 text-center hidden">
            <div class="mb-6">
                <div class="w-20 h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-check text-green-500 text-3xl"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-900 mb-2">Payment Confirmed!</h2>
                <p class="text-gray-600 text-sm mb-6">Your session has been successfully booked.</p>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-center space-x-2">
                    <i class="fas fa-calendar-check text-green-600"></i>
                    <p class="text-sm font-medium text-green-800">Booking Reference: #SB-2025-001234</p>
                </div>
            </div>

            <button onclick="redirectToSuccess()"
                class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                View Booking Details
            </button>
        </div>
    </div>
</div>
