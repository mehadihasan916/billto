<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_packages', function (Blueprint $table) {
            $table->id();
            $table->string('organizationPackageName')->nullable();
            $table->string('organizationPackageDuration')->nullable();
            $table->string('organizationPackageQuantity')->nullable();
            $table->string('limitBillGenerate')->nullable();
            $table->string('price')->nullable();
            $table->string('organizationEmployeeLimitation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_packages');
    }
}
