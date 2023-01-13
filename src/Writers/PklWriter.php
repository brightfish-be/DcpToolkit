<?php

namespace Brightfish\DcpToolkit\Writers;

use Brightfish\DcpToolkit\Exceptions\InputMissingException;
use Brightfish\DcpToolkit\Helpers\CplTime;
use Brightfish\DcpToolkit\Helpers\CplUuid;

class PklWriter extends BaseWriter
{
    /**
     * @throws InputMissingException
     */
    public function __construct(string $name = 'PKL')
    {
        parent::__construct();
        $this->loadFromTemplate('PackingList');
        $this->contents->addChild('Id', CplUuid::prefix4());
        $this->contents->addChild('AnnotationText', $name);
        $this->contents->addChild('IssueDate', CplTime::now());
        $this->contents->addChild('Issuer', $this->Issuer);
        $this->contents->addChild('Creator', $this->Creator);
        $this->contents->addChild('AssetList');
    }

    public function addAsset(string $Filename, string $Id, string $Hash, int $Size, string $Type = 'text/xml;asdcpKind=CPL')
    {
        /*
        <Asset>
            <Id>urn:uuid:7f339e2b-cbe8-4293-98ae-01aadd987ae9</Id>
            <AnnotationText>ADV-PUB2022-10-05AfterEverHappyOV2DS1-ECH-P1</AnnotationText>
            <Hash>aaaaaaaaaaaaaaaaaaaaaaaaaaa</Hash>
            <Size>0</Size>
            <Type>text/xml;asdcpKind=CPL</Type>
            <OriginalFileName>ADV-PUB2022-10-05AfterEverHappyOV2DS1-ECH-P1.xml</OriginalFileName>
        </Asset>
         */
        $AnnotationText = basename($Filename, '.xml');
        $OriginalFileName = basename($Filename);
        $asset = $this->contents->AssetList->addChild('Asset');
        $asset->Id = $Id;
        $asset->AnnotationText = $AnnotationText;
        $asset->Hash = $Hash;
        $asset->Size = $Size;
        $asset->Type = $Type;
        $asset->OriginalFileName = $OriginalFileName;
    }
}
