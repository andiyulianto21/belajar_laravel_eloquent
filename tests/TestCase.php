<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        DB::table('categories')->delete();
        DB::table('vouchers')->delete();
        DB::table('comments')->delete();
        DB::table('wallets')->delete();
        DB::table('customers')->delete();
        DB::table('products')->delete();
    }
}
