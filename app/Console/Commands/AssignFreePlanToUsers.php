<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\SubscriptionPackage;
use App\Models\PaymentGetway;
use App\Models\ComplateInvoiceCount;
use Carbon\Carbon;

class AssignFreePlanToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:assign-free-plan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign Free Plan to all users who do not have a package';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $freePlan = SubscriptionPackage::where('price', '0')->first();

        if (!$freePlan) {
            $this->error('Free Plan not found! Please run the seeder first.');
            return 1;
        }

        $usersWithoutPackage = User::whereDoesntHave('paymentGetway')->get();

        if ($usersWithoutPackage->isEmpty()) {
            $this->info('All users already have packages assigned.');
            return 0;
        }

        $this->info("Found {$usersWithoutPackage->count()} users without packages.");

        $bar = $this->output->createProgressBar($usersWithoutPackage->count());
        $bar->start();

        foreach ($usersWithoutPackage as $user) {
            // Skip admin user
            if ($user->email === 'womenindigitalbd@gmail.com') {
                $bar->advance();
                continue;
            }

            // Assign Free Plan
            PaymentGetway::create([
                'user_id' => $user->id,
                'amount' => '0',
                'subscription_package_id' => $freePlan->id,
                'created_at' => Carbon::now(),
            ]);

            // Create invoice count record
            ComplateInvoiceCount::create([
                'user_id' => $user->id,
                'invoice_count_total' => '0',
                'current_invoice_total' => '0',
                'created_at' => Carbon::now()
            ]);

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('✅ Free Plan assigned to all users successfully!');

        return 0;
    }
}
