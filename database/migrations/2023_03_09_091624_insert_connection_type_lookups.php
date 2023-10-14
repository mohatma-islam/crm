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
        DB::table('connection_type_lookups')->insert(
            array(
                [
                    'value' => 'SFTP',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'SFTP (With Key)',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'value' => 'FTP',
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
        DB::table('connection_type_lookups')->delete();
    }
};
