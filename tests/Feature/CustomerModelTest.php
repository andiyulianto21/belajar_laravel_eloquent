<?php

namespace Tests\Feature;

use App\Models\Customer;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\WalletSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

class CustomerModelTest extends TestCase
{
    public function test_insert() {
        $this->seed(CustomerSeeder::class);

        $result = Customer::find('EKO');
        assertNotNull($result);
    }

    public function test_relationship_one_to_one() {
        $this->seed(CustomerSeeder::class);
        $this->seed(WalletSeeder::class);

        $customer = Customer::find('EKO');
        assertNotNull($customer);
        assertEquals(1250, $customer->wallet->amount);
    }
}
