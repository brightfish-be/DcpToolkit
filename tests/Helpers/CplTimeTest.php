<?php

namespace Brightfish\DcpToolkit\Tests\Helpers;

use Brightfish\DcpToolkit\Helpers\CplTime;
use PHPUnit\Framework\TestCase;

class CplTimeTest extends TestCase
{
    public function test_now()
    {
        $this->assertEquals(29, strlen(CplTime::now()));
    }

    public function test_date()
    {
        $timestamp = strtotime('1 Jan 2023 14:05');
        $this->assertEquals(29, strlen(CplTime::date($timestamp)));
        $this->assertEquals('2023-01-01T14:05:00.000+00:00', CplTime::date($timestamp));
    }

    public function test_format()
    {
        $datetime = '1 Jan 2023 14:05';
        $this->assertEquals('2023-01-01T14:05:00.000+00:00', CplTime::format($datetime));
    }
}
