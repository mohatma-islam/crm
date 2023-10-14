<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id');
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
            $table->unsignedBigInteger('service_level_lookup_id');
            $table->foreign('service_level_lookup_id')->references('id')->on('service_level_lookups')->onDelete('cascade');
            $table->unsignedBigInteger('maintenance_lookup_id');
            $table->foreign('maintenance_lookup_id')->references('id')->on('service_level_maintenance_lookups')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('service_levels');
    }
};
