<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert(
                [
                    [
                        'username' => 'admin',
                        'password' => bcrypt('12345'),
                        'email' => 'admin@admin',
                        'avatar' => 'uploads/uber.jpg',
                        'active' => 'yes',
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime()
                    ],
                    [
                        'username' => 'nhuongph',
                        'password' => bcrypt('12345'),
                        'email' => 'nhuongph@rikkeisoft.com',
                        'avatar' => 'uploads/nhuongph/nhuongph.jpg',
                        'active' => 'yes',
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime()
                    ]
                ]
        );
    }

}
