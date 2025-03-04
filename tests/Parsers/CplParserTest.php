<?php

namespace Brightfish\DcpToolkit\Tests\Parsers;

use Brightfish\DcpToolkit\Exceptions\InputMissingException;
use Brightfish\DcpToolkit\Parsers\CplParser;
use PHPUnit\Framework\TestCase;

class CplParserTest extends TestCase
{
    private string $cpl_file = __DIR__.'/../dcp/1001142-1-EN-AL/CPL_eba29798-3121-4d26-934f-19c2cf0815b3.xml';

    private CplParser $parser;

    /**
     * @throws InputMissingException
     */
    protected function setUp(): void
    {
        $this->parser = new CplParser($this->cpl_file);
    }

    public function test_annotation_text()
    {
        $this->assertEquals(
            'BF-1001142-1-BrightfishJingleIn2023-7s_C_EN-XX_BE-AL_51_2K_BF_20221220_BF_IOP_OV',
            $this->parser->AnnotationText(),
            'CPL Annotation Text'
        );
    }

    public function test_content_title_text()
    {
        $this->assertEquals(
            'BF-1001142-1-BrightfishJingleIn2023-7s_C_EN-XX_BE-AL_51_2K_BF_20221220_BF_IOP_OV',
            $this->parser->ContentTitleText(),
            'CPL Content Title Text'
        );
    }

    public function test_reel_list()
    {
        $this->assertIsObject(
            $this->parser->ReelList(),
            'CPL Reel List'
        );
        $this->assertCount(
            1,
            $this->parser->ReelList(),
            'CPL Reel List'
        );
        /*
        SimpleXMLElement Object
        (
            [Reel] => SimpleXMLElement Object
                (
                    [Id] => urn:uuid:d66ea92c-8557-42d9-bb6e-0a6f010daece
                    [AssetList] => SimpleXMLElement Object
                        (
                            [MainPicture] => SimpleXMLElement Object
                                (
                                    [Id] => urn:uuid:5e9f8cfd-76a4-4479-8065-66835a68f378
                                    [EditRate] => 24 1
                                    [IntrinsicDuration] => 164
                                    [EntryPoint] => 0
                                    [Duration] => 164
                                    [Hash] => 4gNNNEUvnjUACHVFnwaGe/wIav4=
                                    [FrameRate] => 24 1
                                    [ScreenAspectRatio] => 1.90
                                )

                            [MainSound] => SimpleXMLElement Object
                                (
                                    [Id] => urn:uuid:18aafe90-952d-40db-aee8-96b175f87062
                                    [EditRate] => 24 1
                                    [IntrinsicDuration] => 164
                                    [EntryPoint] => 0
                                    [Duration] => 164
                                    [Hash] => HIfFbePlJsigU2YLLbGEg6Ckzvs=
                                )
                        )
                )
        )
         */
    }

    public function test_reel()
    {
        $this->assertIsObject(
            $this->parser->Reel(),
            'CPL Reel'
        );
    }

    public function test_issuer()
    {
        $this->assertEquals(
            'Brightfish Digital',
            $this->parser->Issuer(),
            'CPL Issuer'
        );
    }

    public function test_issue_date()
    {
        $this->assertEquals(
            '2022-12-20T10:35:03+01:00',
            $this->parser->IssueDate(),
            'CPL Issue Date'
        );
    }

    public function test_creator()
    {
        $this->assertEquals(
            'Fraunhofer IIS easyDCP Creator+ 3.8.1',
            $this->parser->Creator(),
            'CPL Creator'
        );
    }

    public function test_id()
    {
        $this->assertEquals(
            'urn:uuid:eba29798-3121-4d26-934f-19c2cf0815b3',
            $this->parser->Id(),
            'CPL Uuid'
        );
    }

    public function test_total_frames()
    {
        $this->assertEquals(164, $this->parser->totalFrames(), 'total frames should be 164');
    }

    public function test_total_seconds()
    {
        $this->assertEquals(6.8333, $this->parser->totalSeconds(), 'total frames should be 6.8333');
    }
}
