<?php

namespace Brightfish\DcpToolkit\Tests\Helpers;

use Brightfish\DcpToolkit\Helpers\CplDigest;
use PHPUnit\Framework\TestCase;

class CplDigestTest extends TestCase
{
    private string $file = __DIR__.'/../dcp/1001142-1-EN-AL/CPL_eba29798-3121-4d26-934f-19c2cf0815b3.xml';

    public function test_file()
    {
        $this->assertEquals('y0lqLuhDoamg4Ehd8dF0BD8XlQs=', CplDigest::file($this->file), 'File Digest');
    }

    public function test_size()
    {
        $this->assertEquals(10631, CplDigest::size($this->file), 'File Size');
    }

    public function test_text()
    {
        $this->assertEquals('7VMBPoZKgeoFo4dlYZ4h79Qd0jA=', CplDigest::text('Input Text'), 'Text Digest');
    }
}
