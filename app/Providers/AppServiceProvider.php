<?php

namespace App\Providers;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        paginator::useBootstrap();
        
        // Share subscription expiration status with all views
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user_id = Auth::id();
                $subscription = Subscription::where('user_id', $user_id)->latest()->first();
                
                $isExpired = false;
                if ($subscription && $subscription->ends_at) {
                    $now = Carbon::now();
                    $end = Carbon::parse($subscription->ends_at);
                    $isExpired = $now->gt($end);
                }
                
                $view->with('subscriptionExpired', $isExpired);
            }
        });
    }
}
