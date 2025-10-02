<?php

namespace App\Services\Payment\Stripe;

use App\Actions\Payments\CreateStripePriceAction;
use App\Actions\Payments\CreateStripeProductAction;
use App\DTO\StripeContext;
use App\Models\MentorProfile;
use App\Models\User;
use Illuminate\Pipeline\Pipeline;

class ProductAndPriceService
{
    public function __construct(public StripeGateway $stripeGateway, public Pipeline $pipeline) {}

    public function createProductAndPrice(User $mentor)
    {
        $mentor->loadMissing('mentorProfile');

        $dataObject = new StripeContext(
            $mentor,
            $this->stripeGateway
        );

        $this->pipeline
            ->send($dataObject)
            ->through([
                CreateStripeProductAction::class,
                CreateStripePriceAction::class,
            ])->then(function (StripeContext $dataObject) {
                /** @var MentorProfile $mentorProfile */
                $mentorProfile = $dataObject->mentor->mentorProfile;

                $mentorProfile->allMentorRates()->update([
                    'is_active' => false,
                ]);

                $mentorProfile->mentorRate()->create([
                    'amount' => $mentorProfile->hourly_rate,
                    'stripe_price_id' => $dataObject->priceId,
                    'stripe_product_id' => $dataObject->productId,
                ]);
            });
    }
}
