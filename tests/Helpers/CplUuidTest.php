<?php

namespace Brightfish\DcpToolkit\Tests\Helpers;

use Brightfish\DcpToolkit\Helpers\CplUuid;
use PHPUnit\Framework\TestCase;

class CplUuidTest extends TestCase
{
    public function testUuidGeneration()
    {
        $this->assertEquals(36, strlen(CplUuid::v4()));
        $this->assertEquals(45, strlen(CplUuid::prefix4()));
    }
}
