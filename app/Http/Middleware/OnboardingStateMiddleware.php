<?php

namespace App\Http\Middleware;

use App\Enums\OnboardingStage;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class OnboardingStateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user->onboarding_stage != OnboardingStage::COMPLETED) {
            return Redirect::to(route('onboarding', absolute: false))
                ->with('onboarding_stage', $user->onboarding_stage);
        }

        return $next($request);
    }
}
