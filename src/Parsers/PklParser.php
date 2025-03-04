<?php

namespace Brightfish\DcpToolkit\Parsers;

use SimpleXMLElement;

class PklParser extends BaseParser
{
    public function AssetList(): SimpleXMLElement
    {
        return $this->xml->AssetList;
    }

    public function Asset(int $id = 0): SimpleXMLElement
    {
        return $this->xml->AssetList->Asset[$id];
        /*
        (
            'Id' => 'urn:uuid:5e9f8cfd-76a4-4479-8065-66835a68f378'
            'AnnotationText' => 'fr000001.j2c - 164 framess'
            'Hash' => '4gNNNEUvnjUACHVFnwaGe/wIav4='
            'Size' => '31438077'
            'Type' => 'application/x-smpte-mxf;asdcpKind=Picture'
            'OriginalFileName' => '5e9f8cfd-76a4-4479-8065-66835a68f378_video.mxf'
        )
         */
    }

    public function totalBytes(): int
    {
        $totalSize = 0;
        foreach ($this->xml->AssetList as $asset) {
            foreach ($asset->Asset as $file) {
                $totalSize += $file->Size;
            }
        }

        return $totalSize;
    }
}
