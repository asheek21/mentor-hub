<div id="checkout-modal" @class([
    "fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm",
    "hidden" => empty($clientSecret)
])>
    <div
        class="relative bg-white rounded-lg shadow-lg overflow-hidden min-w-[320px] min-h-[400px] sm:min-w-[400px] sm:min-h-[500px]">

        <!-- Close Button -->
        <button id="close-checkout" class="cursor-pointer absolute top-2 right-2 text-gray-500 hover:text-black text-xl font-bold z-10">
            ×
        </button>

        <!-- Stripe Mount Point -->
        <div id="checkout" class="w-full h-full"></div>
    </div>
</div>

@script
    <script>
        let activeCheckout = null;

        $wire.on('checkout-created', (clientSecret) => {

            if (activeCheckout) {
                activeCheckout.unmount();
                activeCheckout = null;
            }

            StripeInstance.initEmbeddedCheckout({
                clientSecret: clientSecret[0]
            }).then((checkout) => {
                let checkoutElement = document.getElementById('checkout');
                checkout.mount(checkoutElement);
                activeCheckout = checkout;
            });
        });

        document.getElementById('close-checkout').addEventListener('click', () => {

            $wire.dispatch('checkout-closed');

            if (activeCheckout) {
                activeCheckout.destroy();
                activeCheckout = null;
            }

        });
    </script>
@endscript
