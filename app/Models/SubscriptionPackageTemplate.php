<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPackageTemplate extends Model
{
    use HasFactory;
    protected $table = 'subscription_package_templates';
    protected $fillable = [
        'subscriptionPackageId',
        'template',
    ];
    
}
