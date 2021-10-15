<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;
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
        Account::insert(
            $item = [
                'account_id' => 2,
                'account_name' => 'admin2',
                'email' => 'admin2',
                'password' => bcrypt('admin2'),
                'phonenumber' => '',
                'address' => ''
            ]
        );
    }
}
