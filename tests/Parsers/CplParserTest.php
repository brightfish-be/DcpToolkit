<?php

namespace Brightfish\DcpToolkit\Tests\Parsers;

use Brightfish\DcpToolkit\Parsers\CplParser;
use PHPUnit\Framework\TestCase;

class CplParserTest extends TestCase
{
    private $cpl_file = __DIR__.'/../dcp/1001142-1-EN-AL/CPL_eba29798-3121-4d26-934f-19c2cf0815b3.xml';

    protected function setUp(): void
    {
        $this->parser = new CplParser($this->cpl_file);
    }

    public function testAnnotationText()
    {
        $this->assertEquals(
            'BF-1001142-1-BrightfishJingleIn2023-7s_C_EN-XX_BE-AL_51_2K_BF_20221220_BF_IOP_OV',
            $this->parser->AnnotationText(),
            'CPL Annotation Text'
        );
    }

    public function testContentTitleText()
    {
        $this->assertEquals(
            'BF-1001142-1-BrightfishJingleIn2023-7s_C_EN-XX_BE-AL_51_2K_BF_20221220_BF_IOP_OV',
            $this->parser->ContentTitleText(),
            'CPL Content Title Text'
        );
    }

    public function testReelList()
    {
        $this->assertIsObject(
            $this->parser->ReelList(),
            'CPL Reel List'
        );
        $this->assertEquals(
            1,
            count($this->parser->ReelList()),
            'CPL Reel List'
        );
    }

//    public function testReel()
//    {
//        $this->assertEquals(
//            '',
//            $this->parser->Reel(0),
//            'CPL Reel'
//        );
//    }

    public function testIssuer()
    {
        $this->assertEquals(
            'Brightfish Digital',
            $this->parser->Issuer(),
            'CPL Issuer'
        );
    }

    public function testIssueDate()
    {
        $this->assertEquals(
            '2022-12-20T10:35:03+01:00',
            $this->parser->IssueDate(),
            'CPL Issue Date'
        );
    }

    public function testCreator()
    {
        $this->assertEquals(
            'Fraunhofer IIS easyDCP Creator+ 3.8.1',
            $this->parser->Creator(),
            'CPL Creator'
        );
    }

    public function testId()
    {
        $this->assertEquals(
            'urn:uuid:eba29798-3121-4d26-934f-19c2cf0815b3',
            $this->parser->Id(),
            'CPL Uuid'
        );
    }
}
