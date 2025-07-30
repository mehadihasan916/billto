<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubscriptionPackage;
use App\Models\Pricing;
use App\Models\SubscriptionPackageTemplate;

class SubscriptionPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        $basicTemplateIds = [1]; // You may need to adjust these IDs based on your actual templates
        foreach ($basicTemplateIds as $templateId) {
            SubscriptionPackageTemplate::create([
                'subscriptionPackageId' => $freePlan->id,
                'template' => $templateId,
            ]);
        }

        // Create Stander Plan
        $standerPlan = SubscriptionPackage::create([
            'packageName' => 'STANDER',
            'packageNamebn' => 'স্ট্যান্ডার',
            'packageDuration' => '60',
            'price' => '10',
            'pricebn' => '1600',
            'templateQuantity' => '10',
            'templateQuantitybn' => '১০',
            'limitInvoiceGenerate' => '3',
            'limitInvoiceGeneratebn' => '৩',
        ]);

        $standerPlanPricing = [
            [
                'logo' => 'Success',
                'description' => 'Create up to 100 invoices per month',
                'descriptionbn' => 'মাসে সর্বোচ্চ ১০০টি চালান তৈরি করুন'
            ],
            [
                'logo' => 'Success',
                'description' => 'Access to 10 templates',
                'descriptionbn' => '১০টি টেমপ্লেট ব্যবহার করতে পারবেন'
            ],
            [
                'logo' => 'Success',
                'description' => 'Standard support',
                'descriptionbn' => 'স্ট্যান্ডার্ড সহায়তা'
            ],
            [
                'logo' => 'Success',
                'description' => 'Advanced invoice features',
                'descriptionbn' => 'উন্নত চালান বৈশিষ্ট্য'
            ],
            [
                'logo' => 'Cross',
                'description' => 'No priority support',
                'descriptionbn' => 'অগ্রাধিকার সহায়তা নেই'
            ]
        ];

        foreach ($standerPlanPricing as $pricing) {
            Pricing::create([
                'subscription_package_id' => $standerPlan->id,
                'logo' => $pricing['logo'],
                'description' => $pricing['description'],
                'descriptionbn' => $pricing['descriptionbn'],
            ]);
        }

        // Assign templates to stander plan (assuming template IDs 1-10)
        $standerTemplateIds = range(1, 3);
        foreach ($standerTemplateIds as $templateId) {
            SubscriptionPackageTemplate::create([
                'subscriptionPackageId' => $standerPlan->id,
                'template' => $templateId,
            ]);
        }

        // Create Premium Plan
        $premiumPlan = SubscriptionPackage::create([
            'packageName' => 'PREMIUM',
            'packageNamebn' => 'প্রিমিয়াম',
            'packageDuration' => '90',
            'price' => '20',
            'pricebn' => '2500',
            'templateQuantity' => 'Unlimited',
            'templateQuantitybn' => 'সীমাহীন',
            'limitInvoiceGenerate' => '5',
            'limitInvoiceGeneratebn' => '৫',
        ]);

        $premiumPlanPricing = [
            [
                'logo' => 'Success',
                'description' => 'Unlimited invoices per month',
                'descriptionbn' => 'মাসে সীমাহীন চালান তৈরি করুন'
            ],
            [
                'logo' => 'Success',
                'description' => 'Access to all templates',
                'descriptionbn' => 'সব টেমপ্লেট ব্যবহার করতে পারবেন'
            ],
            [
                'logo' => 'Success',
                'description' => 'Priority support',
                'descriptionbn' => 'অগ্রাধিকার সহায়তা'
            ],
            [
                'logo' => 'Success',
                'description' => 'All advanced features',
                'descriptionbn' => 'সব উন্নত বৈশিষ্ট্য'
            ]
        ];

        foreach ($premiumPlanPricing as $pricing) {
            Pricing::create([
                'subscription_package_id' => $premiumPlan->id,
                'logo' => $pricing['logo'],
                'description' => $pricing['description'],
                'descriptionbn' => $pricing['descriptionbn'],
            ]);
        }

        // Assign all templates to premium plan (assuming template IDs 1-20)
        $premiumTemplateIds = range(1, 5);
        foreach ($premiumTemplateIds as $templateId) {
            SubscriptionPackageTemplate::create([
                'subscriptionPackageId' => $premiumPlan->id,
                'template' => $templateId,
            ]);
        }

        $this->command->info('Free, Stander, and Premium Plans created successfully!');
    }
}
