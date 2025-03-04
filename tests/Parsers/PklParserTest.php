<?php

namespace Brightfish\DcpToolkit\Tests\Parsers;

use Brightfish\DcpToolkit\Parsers\PklParser;
use PHPUnit\Framework\TestCase;

class PklParserTest extends TestCase
{
    private string $pkl_file = __DIR__.'/../dcp/1001142-1-EN-AL/PKL_31c13edb-f925-4878-b6cc-546dd055fb96.xml';

    private PklParser $parser;

    protected function setUp(): void
    {
        $this->parser = new PklParser($this->pkl_file);
    }

    public function test_id()
    {
        $this->assertEquals(
            'urn:uuid:31c13edb-f925-4878-b6cc-546dd055fb96',
            $this->parser->Id(),
            'PKL Uuid'
        );
    }

    public function test_creator()
    {
        $this->assertEquals(
            'Fraunhofer IIS easyDCP Creator+ 3.8.1',
            $this->parser->Creator(),
            'PKL Creator'
        );
    }

    public function test_issuer()
    {
        $this->assertEquals(
            'Brightfish Digital',
            $this->parser->Issuer(),
            'PKL Issuer'
        );
    }

    public function test_issue_date()
    {
        $this->assertEquals(
            '2022-12-20T10:35:03+01:00',
            $this->parser->IssueDate(),
            'PKL Issue Date'
        );
    }

    public function test_annotation_text()
    {
        $this->assertEquals(
            'BF-1001142-1-BrightfishJingleIn2023-7s_C_EN-XX_BE-AL_51_2K_BF_20221220_BF_IOP_OV',
            $this->parser->AnnotationText(),
            'PKL Annotation Text'
        );
    }

    public function test_content_title_text()
    {
        $this->assertEquals(
            '',
            $this->parser->ContentTitleText(),
            'PKL Content Title Text'
        );
    }

    public function test_asset_list()
    {
        $this->assertIsObject(
            $this->parser->AssetList(),
            'PKL Asset List'
        );
    }

    public function test_asset()
    {
        $this->assertIsObject(
            $this->parser->Asset(0),
            'PKL Asset'
        );
        $asset = $this->parser->Asset(0);
        $this->assertEquals(31438077, (int) $asset->Size, 'PKL Asset Size');
    }

    public function test_total_size()
    {
        $this->assertEquals(37372682, $this->parser->totalBytes(), 'Total size should be 37372682');

    }
}
