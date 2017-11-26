<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Plan;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::insert([
            [
                'name' => 'small',
                'price' => 10,
            ],
            [
                'name' => 'medium',
                'price' => 20,
            ],
            [
                'name' => 'big',
                'price' => 30,
            ]
        ]);
        User::insert([
            [
                'name' => 'some name',
                'email' => 'test@mail.com',
                'password' => 12341234,
            ],
            [
                'name' => 'some name',
                'email' => 'test1@mail.com',
                'password' => 12341234,
            ],
            [
                'name' => 'some name',
                'email' => 'test2@mail.com',
                'password' => 12341234,
            ]
        ]);
    }
}
