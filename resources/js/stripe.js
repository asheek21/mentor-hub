import {loadStripe} from '@stripe/stripe-js';

const publishablekey = import.meta.env.VITE_STRIPE_PUBLIC_KEY ;

async function initStripe() {
    const stripe = await loadStripe(publishablekey);
    window.StripeInstance = stripe;
}

initStripe();
