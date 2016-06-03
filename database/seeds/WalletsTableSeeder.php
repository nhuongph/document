<?php

use Illuminate\Database\Seeder;

class WalletsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('Wallets')->insert(
                [
                    [
                        'name' => 'Uber1',
                        'type_money' => '$',
                        'money' => '1000',
                        'note' => '',
                        'image' => 'upload/uber.jpg',
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime()
                    ],
                    [
                        'name' => 'VietComBank',
                        'type_money' => 'đ',
                        'money' => '10000000',
                        'note' => '',
                        'image' => 'upload/vietcombank.jpg',
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime()
                    ]
                ]
        );
    }

}
