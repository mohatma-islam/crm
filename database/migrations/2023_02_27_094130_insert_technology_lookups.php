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
        DB::table('technology_lookups')->insert(
            array(
                [
                    'value' => 'Laravel',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'Wordpress',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'Magento',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'Shopware',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'Shopify',
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
        DB::table('technology_lookups')->delete();
    }
};
