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
        DB::table('deal_stage_lookups')->insert(
            array(
                [
                    'value' => 'New',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'Proposal',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'Negotiation',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'Won',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'Lost',
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
        DB::table('deal_stage_lookups')->delete();
    }
};
