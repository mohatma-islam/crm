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
        DB::table('service_level_maintenance_lookups')->insert(
            array(
                [
                    'value' => 'Monthly',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'Quaterly',
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
        DB::table('service_level_maintenance_lookups')->delete();
    }
};
