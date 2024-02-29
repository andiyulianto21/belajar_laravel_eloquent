<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertTrue;

class VoucherModelTest extends TestCase
{
    public function test_uuids() {
        $voucher = new Voucher([
            'name' => 'voucher 1',
            'voucher_code' =>'aflskfafjasdfjkasfjs131'
        ]);
        $voucher->save();
        assertNotNull($voucher->id);
    }

    public function test_multiple_uuids() {
        $voucher = new Voucher([
            'name' => 'voucher 1'
        ]);
        $voucher->save();
        assertNotNull($voucher->id);
        assertNotNull($voucher->voucher_code);
    }
}
