@push('custom-css')
    <style>
        .loader {
            border: 2px solid #f3f3f6;
            border-top: 2px solid #3b82f6;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-right: 8px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .btn-loading {
            position: relative;
            pointer-events: none;
            opacity: 0.7;
        }
        .btn-loading .loader {
            margin-right: 8px;
        }
    </style>
@endpush
<div>
    <livewire:booking.header :menteeBookingSession="$menteeBookingSession"/>

    <livewire:components.payment-modal :mentor="$mentor" :menteeProfileUuid="$menteeProfileUuid"/>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <livewire:booking.hero :mentor="$mentor" />

        <div class="bg-white rounded-lg shadow-sm border p-6">
            <livewire:booking.calendar :mentor="$mentor" />

            @error('selectedDate') <span class="error">{{ $message }}</span> @enderror

            <form wire:submit.prevent="bookSession" >
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Session Details</h3>
                    <div class="space-y-6">
                        <!-- Meeting Notes -->
                        <div>
                            <label for="meetingNotes" class="block text-sm font-medium text-gray-700 mb-2">
                                Anything the mentor should know about or prepare for this meeting?
                            </label>
                            <textarea
                                wire:model="meeting_notes"
                                rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                placeholder="Share your goals, specific topics you'd like to discuss, current challenges, or any background information that would help the mentor prepare for your session..."
                            ></textarea>
                        </div>

                        @error('meeting_notes') <span class="error">{{ $message }}</span> @enderror

                        <!-- File Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Any relevant files (optional)
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                                <input
                                    wire:model="upload_files"
                                    type="file" id="fileUpload" multiple class="hidden" accept=".pdf,.doc,.docx,.txt,.png,.jpg,.jpeg"
                                >
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                <p class="text-gray-600 mb-2">Click to upload files or drag and drop</p>
                                <p class="text-sm text-gray-500">PDF, DOC, TXT, PNG, JPG up to 2MB each</p>
                                <button type="button" onclick="document.getElementById('fileUpload').click()" class="mt-3 bg-white border border-gray-300 rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    Choose Files
                                </button>
                            </div>
                            <div id="uploadedFiles" class="mt-3 space-y-2">
                                @foreach ($all_files as $all_file)
                                    <div
                                        wire:key="uploaded_count-{{ $loop->index }}"
                                        class="flex items-center justify-between bg-white border border-gray-200 rounded-lg p-3">
                                        <div class="flex items-center space-x-3">
                                            <i class="fas fa-file text-gray-400"></i>
                                            <span class="text-sm font-medium text-gray-900">{{ $all_file->getClientOriginalName() }}</span>
                                        </div>
                                        <button wire:click="removeFile({{ $loop->index }})" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            @error('all_files') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                    </div>
                </div>

                <livewire:booking.summary :mentor="$mentor"/>

                <button
                    type="submit"
                    class="cursor-pointer w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed"
                    @if ((empty($selectedTimeSlot) && empty($selectedDate)) || $loadingCheckout) disabled @endif
                    wire:loading.attr="disabled"
                >
                     @if ($loadingCheckout)
                        <span class="loader"></span>
                        <span>Processing Payment...</span>
                    @else
                        Confirm Booking & Pay {{ rupeeFormatter($mentor->mentorProfile->hourly_rate) }}
                    @endif
                </button>
            </form>
        </div>
    </div>

</div>

