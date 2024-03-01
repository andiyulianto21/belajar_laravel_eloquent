<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Database\Seeders\VoucherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;
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

    public function test_soft_delete() {
        $this->seed(VoucherSeeder::class);

        Voucher::where('name', '=', 'kode natal')
            ->first()
            ->delete();

        $result = Voucher::where('name', '=', 'kode natal')->first();
        assertNull($result);
        
        $result = Voucher::withTrashed()->where('name', '=', 'kode natal')->first();
        assertNotNull($result);
    }

    public function test_local_scope() {
        Voucher::insert([
            [
                'id' => Uuid::uuid4(),
                'name' => 'kode lebaran',
                'is_active' => true,
                'voucher_code' => 'lebaranraya'
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'kode imlek',
                'is_active' => false,
                'voucher_code' => 'imlekraya'
            ]
        ]);

        $result = Voucher::nonActive()->where('name', '=', 'kode imlek')->get();
        assertNotNull($result);
    }
}
