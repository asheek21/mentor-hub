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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .overlay {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
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

<div class="fixed inset-0 bg-opacity-40 backdrop-blur-sm overlay flex items-center justify-center z-50 transition-opacity duration-300">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 scale-in" x-data="paymentSteps()" x-init="watchForLivewireEvents()">
        <!-- Payment Confirmation Content -->
        <div id="paymentConfirmationContent" class="p-8" x-show="!showSuccessContent" x-transition>
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
                            <p class="font-medium text-gray-900" id="mentorName">Session with {{ $mentor->full_name }}
                            </p>
                            <p class="text-sm text-gray-600" id="sessionDateTime">
                                {{ \Carbon\Carbon::parse($booking->schedule)->format('M d, Y \a\t g:i A') }}</p>
                        </div>
                        <span class="font-semibold text-lg text-gray-900"
                            id="sessionAmount">{{ rupeeFormatter($booking->price) }}</span>
                    </div>
                </div>

                <!-- Progress Steps -->
                <div class="space-y-4 text-left mb-8">
                    <!-- Step 1: Payment Submitted -->
                    <div class="flex items-center space-x-4">
                        <div :class="step1.completed ? 'bg-green-500' : 'bg-blue-500'"
                            class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">
                            <template x-if="step1.completed">
                                <i class="fas fa-check text-white text-sm"></i>
                            </template>
                            <template x-if="!step1.completed">
                                <div class="loader-small"></div>
                            </template>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Payment Submitted</p>
                            <p class="text-xs text-gray-500">Your payment has been successfully processed</p>
                        </div>
                    </div>

                    <!-- Step 2: Bank Validation -->
                    <div class="flex items-center space-x-4">
                        <div :class="step2.status === 'pending' ? 'bg-blue-500' : (step2.status === 'done' ? 'bg-green-500' :
                            'bg-gray-300')"
                            class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">
                            <template x-if="step2.status === 'done'">
                                <i class="fas fa-check text-white text-sm"></i>
                            </template>
                            <template x-if="step2.status === 'pending'">
                                <div class="loader-small"></div>
                            </template>
                            <template x-if="step2.status === 'idle'">
                                <i class="fas fa-spinner text-gray-500 text-sm"></i>
                            </template>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Bank Validation</p>
                            <p class="text-xs text-gray-500" x-text="step2.label"></p>
                        </div>
                    </div>

                    <!-- Step 3: Booking Confirmation -->
                    <div class="flex items-center space-x-4">
                        <div :class="step3.status === 'pending' ? 'bg-blue-500' : (step3.status === 'done' ? 'bg-green-500' :
                            'bg-gray-300')"
                            class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">
                            <template x-if="step3.status === 'done'">
                                <i class="fas fa-check text-white text-sm"></i>
                            </template>
                            <template x-if="step3.status === 'pending'">
                                <div class="loader-small"></div>
                            </template>
                            <template x-if="step3.status === 'idle'">
                                <i class="fas fa-calendar text-gray-500 text-sm"></i>
                            </template>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Booking Confirmation</p>
                            <p class="text-xs text-gray-500" x-text="step3.label"></p>
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
        <div id="paymentSuccessContent" class="p-8 text-center" x-show="showSuccessContent" x-transition>
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
                    <p class="text-sm font-medium text-green-800">Booking Reference: #{{ $booking->reference_number }}</p>
                </div>
            </div>

            <p class="text-sm text-gray-500">Redirecting in 5 seconds...</p>
        </div>
    </div>
</div>

@push('custom-script')
    <script>

        function paymentSteps() {
            return {
                showSuccessContent: false,
                step1: {
                    completed: true
                },
                step2: {
                    status: 'idle',
                    label: 'Validating payment with your bank...'
                },
                step3: {
                    status: 'idle',
                    label: 'Creating your session booking...'
                },

                watchForLivewireEvents() {
                    Livewire.on('paymentReceived', () => {
                        this.step2.status = 'pending';
                        setTimeout(() => {
                            this.step2.status = 'done';
                            this.step2.label = 'Payment validated successfully';

                            this.step3.status = 'pending';
                            this.step3.label = 'Setting up your session...';

                            setTimeout(() => {
                                this.step3.status = 'done';
                                this.step3.label = 'Session booked successfully';

                                setTimeout(() => {
                                    this.showSuccessContent = true;

                                     setTimeout(() => {
                                        // window.location.href = '/booking/details';
                                       Livewire.dispatch("redirect-success") ;

                                    }, 2000);

                                }, 1000);

                            }, 2000);

                        }, 2000);

                    });
                }
            }
        }
    </script>
@endpush

