<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;


class CustomerSeeder extends Seeder
{
    public function run()
    {
        //create 1 copy sample
        Customer::factory()->count(1)->create();
    }
}

