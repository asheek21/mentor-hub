<div>
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button
                    @click="$dispatch('invalidate-session')"
                    class="text-gray-400 hover:text-gray-600 cursor-pointer">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900">Book a Session</h1>
                </div>

                <div
                     x-data="{
                        time: @js($timeLeftSeconds),
                        interval: null,
                        get minutes() { return Math.floor(this.time / 60); },
                        get seconds() { return this.time % 60; },
                        start() {
                            this.interval = setInterval(() => {
                                if (this.time > 0) {
                                    this.time--;
                                } else {
                                    clearInterval(this.interval);
                                    $wire.dispatch('invalidate-session');
                                }
                            }, 1000);
                        }
                    }"
                    x-init="start()"
                    class="flex items-center space-x-2 bg-orange-50 border border-orange-200 rounded-lg px-3 py-2"
                >
                    <i class="fas fa-clock text-orange-500"></i>
                    <span class="text-sm font-medium text-orange-700" id="countdownTimer">
                        <span x-text="minutes"></span>:<span x-text="seconds.toString().padStart(2, '0')"></span>
                    </span>
                </div>

            </div>
        </div>
    </header>
</div>
