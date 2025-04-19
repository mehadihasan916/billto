<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationPackageTemplate extends Model
{
    use HasFactory;
    protected $table = 'organization_package_templates';
    protected $fillable = [
        'organizationPackageId',
        'template',
        'company'
    ];
}
