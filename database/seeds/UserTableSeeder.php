<?php

use Illuminate\Database\Seeder;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Let's truncate our existing records to start from scratch.
        User::truncate();

        User::create([
                'name'     => 'Lone Wolf',
                'email'    => 'admin@example.com',
                'password' => '$2y$10$4vd6iSf.xH4ltIbNgOWkF.QPYTU.6QgOBMI921RNIWsu.bws3utaW',
                'is_admin' => 1,
            ]);
    }
}
