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
        DB::table('service_level_lookups')->insert(
            array(
                [
                    'value' => 'Bronze (Frost), SLA - Tier 1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'Silver (Frost), SLA - Tier 2',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'Gold (Frost), SLA - Tier 3',
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
        DB::table('service_level_lookups')->delete();
    }
};
