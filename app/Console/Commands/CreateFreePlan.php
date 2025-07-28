<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SubscriptionPackage;
use App\Models\Pricing;
use App\Models\SubscriptionPackageTemplate;

class CreateFreePlan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:create-free-plan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the Free Plan subscription package';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Check if Free Plan already exists
        $existingFreePlan = SubscriptionPackage::where('packageName', 'Free Plan')->first();

        if ($existingFreePlan) {
            $this->error('Free Plan already exists!');
            return 1;
        }

        // Create Free Plan
        $freePlan = SubscriptionPackage::create([
            'packageName' => 'Free Plan',
            'packageNamebn' => 'ফ্রি প্ল্যান',
            'packageDuration' => '30',
            'price' => '0',
            'pricebn' => '০',
            'templateQuantity' => '3',
            'templateQuantitybn' => '৩',
            'limitInvoiceGenerate' => '5',
            'limitInvoiceGeneratebn' => '৫',
        ]);

        // Add pricing descriptions for Free Plan
        $freePlanPricing = [
            [
                'logo' => 'Success',
                'description' => 'Create up to 5 invoices per month',
                'descriptionbn' => 'মাসে সর্বোচ্চ ৫টি চালান তৈরি করুন'
            ],
            [
                'logo' => 'Success',
                'description' => 'No credit card required',
                'descriptionbn' => 'ক্রেডিট কার্ডের প্রয়োজন নেই'
            ],
            [
                'logo' => 'Success',
                'description' => 'Perfect for individuals or small teams',
                'descriptionbn' => 'ব্যক্তি বা ছোট দলের জন্য উপযুক্ত'
            ],
            [
                'logo' => 'Success',
                'description' => 'Basic invoice templates',
                'descriptionbn' => 'মৌলিক চালান টেমপ্লেট'
            ],
            [
                'logo' => 'Cross',
                'description' => 'No advanced features',
                'descriptionbn' => 'উন্নত বৈশিষ্ট্য নেই'
            ],
            [
                'logo' => 'Cross',
                'description' => 'No priority support',
                'descriptionbn' => 'অগ্রাধিকার সহায়তা নেই'
            ]
        ];

        foreach ($freePlanPricing as $pricing) {
            Pricing::create([
                'subscription_package_id' => $freePlan->id,
                'logo' => $pricing['logo'],
                'description' => $pricing['description'],
                'descriptionbn' => $pricing['descriptionbn'],
            ]);
        }

        // Assign basic templates to free plan (assuming template IDs 1, 2, 3 are basic templates)
        $basicTemplateIds = [1, 2, 3]; // You may need to adjust these IDs based on your actual templates
        foreach ($basicTemplateIds as $templateId) {
            SubscriptionPackageTemplate::create([
                'subscriptionPackageId' => $freePlan->id,
                'template' => $templateId,
            ]);
        }

        $this->info('✅ Free Plan created successfully!');
        $this->info('Package ID: ' . $freePlan->id);
        $this->info('Price: £0/month');
        $this->info('Invoice Limit: 5 per month');
        $this->info('Templates: 3 basic templates');

        return 0;
    }
}
