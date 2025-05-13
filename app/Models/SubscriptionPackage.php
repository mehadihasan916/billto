<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPackage extends Model
{
    use HasFactory;
    protected $table = 'subscription_packages';
    protected $fillable = [
        'packageDuration',
        'packageDurationbn',
        'price',
        'pricebn',
        'templateQuantity',
        'limitInvoiceGenerate',
        'templateQuantitybn',
        'limitInvoiceGeneratebn',
    ];

    public function templates()
    {
        return $this->belongsToMany(InvoiceTemplate::class, 'subscription_package_templates', 'subscriptionPackageId', 'template');
    }
}
