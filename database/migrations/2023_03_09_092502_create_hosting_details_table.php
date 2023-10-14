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
        Schema::create('hosting_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id');
            $table->text('forge_server_id')->nullable();
            $table->text('host_name');
            $table->text('host_username');
            $table->text('host_password');
            $table->text('host_port_number');
            $table->unsignedBigInteger('server_supplier_lookup_id');
            $table->unsignedBigInteger('connection_type_lookup_id');
            $table->foreign('server_supplier_lookup_id')->references('id')->on('server_supplier_lookups')->onDelete('cascade');
            $table->foreign('connection_type_lookup_id')->references('id')->on('connection_type_lookups')->onDelete('cascade');
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
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
        Schema::dropIfExists('hosting_details');
    }
};
