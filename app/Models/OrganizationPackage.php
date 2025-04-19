<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationPackage extends Model
{
    use HasFactory;
    protected $table = 'organization_packages';
    protected $fillable = [
        'organizationPackageName',
        'organizationPackageDuration',
        'organizationPackageQuantity',
        'limitBillGenerate',
        'price',
        'organizationEmployeeLimitation'
    ];
}
