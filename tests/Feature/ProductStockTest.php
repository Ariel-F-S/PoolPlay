<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ProductStockTest extends TestCase
{
    public function test_cek_ketersediaan_stok_tersedia()
    {
        $stok = 10;
        $isAvailable = $stok > 0;

        $this->assertTrue($isAvailable);
    }
}