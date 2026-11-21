<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CurrencyFormatTest extends TestCase
{
    public function test_format_rupiah_pemisah_ribuan()
    {
        $harga = 50000;
        $formatted = 'Rp' . number_format($harga, 0, ',', '.');
        
        $this->assertEquals('Rp50.000', $formatted);
    }
}