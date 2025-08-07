<?php

namespace App\Console\Commands;

use App\Mail\SubscriptionExpired;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class AutoSendExpiredMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:send-expired-mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'automatically send emails to users with expired subscriptions';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $users = User::with(['latestSubscription', 'subscription'])->get();

        foreach ($users as $user) {
            if ($user->latestSubscription && !$user->latestSubscription->notified) {
                $latestSub = $user->latestSubscription;
                $endsAt = Carbon::parse($latestSub->ends_at);

                if ($endsAt->isPast()) {
                    echo "User: {$user->email} | Subscription expired on " . $latestSub->ends_at . PHP_EOL;
                    Mail::to($user->email)->send(new SubscriptionExpired($user));
                } else {
                    echo "User: {$user->email} | Subscription valid until " . $latestSub->ends_at . PHP_EOL;
                }
            } else {
                echo "User: {$user->email} | No subscriptions found." . PHP_EOL;
            }
        }

        $this->info("Expired subscription mails sent.");
    }
}
