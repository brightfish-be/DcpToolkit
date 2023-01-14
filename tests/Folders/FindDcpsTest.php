<?php

namespace Brightfish\DcpToolkit\Tests\Folders;

use Brightfish\DcpToolkit\Exceptions\InputMissingException;
use Brightfish\DcpToolkit\Folders\FindDcps;
use PHPUnit\Framework\TestCase;

class FindDcpsTest extends TestCase
{
    /**
     * @throws InputMissingException
     */
    public function testFind()
    {
        $dcps = FindDcps::find(__DIR__.'/../..', 5);
        $this->assertNotEmpty($dcps, 'DCP found');
        $this->assertEquals('1001142-1-EN-AL', basename($dcps[0]), '');
    }
}
