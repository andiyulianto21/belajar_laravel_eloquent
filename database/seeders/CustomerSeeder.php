<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::insert([
            'id' => 'EKO',
            'name' => 'Eko',
            'email' => 'eko@gmail.com'
        ]);
    }
}
