<?php

namespace Brightfish\DcpToolkit\Writers;

use Brightfish\DcpToolkit\Helpers\CplTime;
use Brightfish\DcpToolkit\Helpers\CplUuid;
use Brightfish\DcpToolkit\Parsers\BaseParser;

class MapWriter extends BaseWriter
{
    /**
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->loadFromTemplate('AssetMap');
        $this->contents->addChild('Id', CplUuid::prefix4());
        $this->contents->addChild('VolumeCount', 1);
        $this->contents->addChild('IssueDate', CplTime::now());
        $this->contents->addChild('Issuer', $this->Issuer);
        $this->contents->addChild('Creator', $this->Creator);
        $this->contents->addChild('AssetList');
    }

    public function addAsset(string $filename, string $type = 'CPL')
    {
        /*
        <Asset>
          <Id>urn:uuid:fe0f6cf1-04eb-4482-8c51-7f004ae71b7a</Id>
          <ChunkList>
            <Chunk>
              <Path>ADV-PUB2022-10-05AfterEverHappyOV2DS1-MAIN-P2.xml</Path>
              <VolumeIndex>1</VolumeIndex>
            </Chunk>
          </ChunkList>
        </Asset>
         */
        $asset = $this->contents->AssetList->addChild('Asset');
        $asset->addChild('Id', (new BaseParser($filename))->Id());
        if ($type == 'PKL') {
            $asset->addChild('PackingList');
        }
        $chunk = $asset->addChild('ChunkList')->addChild('Chunk');
        $chunk->addChild('Path', basename($filename));
        $chunk->addChild('VolumeIndex', 1);
    }
}
