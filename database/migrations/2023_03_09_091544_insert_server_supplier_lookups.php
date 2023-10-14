<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::table('server_supplier_lookups')->insert(
            array(
                [
                    'value' => 'AWS',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'WP Engine',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'Client Provided',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'Other',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('server_supplier_lookups')->delete();
    }
};
