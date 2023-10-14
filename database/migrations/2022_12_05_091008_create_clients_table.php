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
        Schema::create('clients', function (Blueprint $table) {
           $table->id();
           $table->string("client_name");
           $table->unsignedBigInteger("client_account_manager_id");
           $table->string("client_postal_address");
           $table->timestamps();
           $table->softDeletes();
           $table->foreign('client_account_manager_id')
           ->references('id')->on('users')
           ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
