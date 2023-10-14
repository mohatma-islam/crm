<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Activity;
use App\Models\Client;
use App\Models\ClientContact;
use App\Models\Deal;
use App\Models\HostingDetail;
use App\Models\ServiceLevel;
use App\Models\Technology;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Website;
use Database\Factories\ActivityFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'user_name' => 'Kyle Lindsay',
            'user_email' => 'kyle@fifteen.co.uk',
            'password' => bcrypt('123')
        ]);

        User::factory()->create([
            'user_name' => 'Sam Doyle',
            'user_email' => 'sam@fifteen.co.uk',
            'password' => bcrypt('123')
        ]);

        User::factory()->create([
            'user_name' => 'Mohatma Islam',
            'user_email' => 'mohatma@fifteen.co.uk',
            'password' => bcrypt('123')
        ]);

        User::factory()->create([
            'user_name' => 'David Pember',
            'user_email' => 'david@fifteen.co.uk',
            'password' => bcrypt('123')
        ]);

        User::factory()->create([
            'user_name' => 'James Frost',
            'user_email' => 'james@fifteen.co.uk',
            'password' => bcrypt('123')
        ]);
        
        // User::factory(5)->create();
        Client::factory(100)->create();
        Website::factory(50)->create();
        ClientContact::factory(50)->create();
        HostingDetail::factory(50)->create();
        ServiceLevel::factory(50)->create();
        Technology::factory(50)->create();
        Activity::factory(50)->create();
        Transaction::factory(50)->create();
        Deal::factory(100)->create();
    }
}
