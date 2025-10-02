<?php

namespace App\Webhooks;

use Spatie\WebhookClient\Jobs\ProcessWebhookJob as SpatieProcessWebhookJob;

class StripeWebhook extends SpatieProcessWebhookJob
{
    public function handle()
    {
        return http_response_code(200);
    }
}
