<?php

namespace Brightfish\DcpToolkit\Tests\Folders;

use Brightfish\DcpToolkit\Exceptions\InputMissingException;
use Brightfish\DcpToolkit\Folders\AnalyzeDcp;
use PHPUnit\Framework\TestCase;

class AnalyzeDcpTest extends TestCase
{
    /**
     * @throws InputMissingException
     */
    public function testSimple()
    {
        $dcpFolder = __DIR__.'/../dcp/1001142-1-EN-AL';
        $dcpObject = AnalyzeDcp::simple($dcpFolder);
        $this->assertNotEmpty($dcpObject->mxfVideo);
        $this->assertNotEmpty($dcpObject->mxfAudio);
        $this->assertNotEmpty($dcpObject->cplFile);
        $this->assertNotEmpty($dcpObject->pklFile);
        $this->assertNotEmpty($dcpObject->AssetMap);
        $this->assertNotEmpty($dcpObject->VolIndex);
    }
}
