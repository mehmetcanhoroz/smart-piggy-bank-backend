<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                [
                    'id' => 2,
                    'name' => 'Child User',
                    'email' => 'child@gmail.com',
                    'password' => bcrypt('123456'),
                    'is_parent' => false
                ]
            ]
        );

        DB::table('transactions')->insert(
            [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'unknown_item_count' => 0,
                    'created_at' => \Carbon\Carbon::today()
                ],
                [
                    'id' => 2,
                    'user_id' => 1,
                    'unknown_item_count' => 1,
                    'created_at' => \Carbon\Carbon::yesterday()
                ],
                [
                    'id' => 3,
                    'user_id' => 2,
                    'unknown_item_count' => 0,
                    'created_at' => \Carbon\Carbon::today()->addDays(-2)
                ],
                [
                    'id' => 4,
                    'user_id' => 2,
                    'unknown_item_count' => 3,
                    'created_at' => \Carbon\Carbon::today()->addDays(-3)
                ],
            ]
        );


        DB::table('coins')->insert(
            [
                [
                    'id' => 1,
                    'transaction_id' => 1,
                    'value' => 0.25,
                ],
                [
                    'id' => 2,
                    'transaction_id' => 1,
                    'value' => 1,
                ],

                [
                    'id' => 3,
                    'transaction_id' => 2,
                    'value' => 0.10,
                ],
                [
                    'id' => 4,
                    'transaction_id' => 2,
                    'value' => 0.50,
                ],

                [
                    'id' => 5,
                    'transaction_id' => 3,
                    'value' => 0.01,
                ],
                [
                    'id' => 6,
                    'transaction_id' => 3,
                    'value' => 0.25,
                ],

                [
                    'id' => 7,
                    'transaction_id' => 4,
                    'value' => 1,
                ],
                [
                    'id' => 8,
                    'transaction_id' => 4,
                    'value' => 1,
                ],
            ]
        );

        DB::table('images')->insert(
            [
                [
                    'id' => 1,
                    'transaction_id' => 1,
                    'image' => 'https://image.shutterstock.com/image-photo/india-circulating-coins-collection-set-260nw-201607463.jpg',
                ],
                [
                    'id' => 2,
                    'transaction_id' => 2,
                    'image' => 'https://www.thesun.co.uk/wp-content/uploads/2019/01/AD-COMPOSITE-Coin-V4.jpg',
                ],

                [
                    'id' => 3,
                    'transaction_id' => 3,
                    'image' => 'https://upload.wikimedia.org/wikipedia/commons/b/b9/Euro_coins_line.jpg',
                ],
                [
                    'id' => 4,
                    'transaction_id' => 4,
                    'image' => 'https://www.coincraft.com/content/images/thumbs/0006658_sri-lanka-10-coins_340.jpeg',
                ],
            ]
        );
    }
}
