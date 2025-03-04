<?php

namespace Brightfish\DcpToolkit\Parsers;

use Brightfish\DcpToolkit\Helpers\DcpValues;
use SimpleXMLElement;

class CplParser extends BaseParser
{
    public function ReelList(): ?SimpleXMLElement
    {
        return $this->xml->ReelList ?? null;
    }

    public function Reel(int $id = 0): ?SimpleXMLElement
    {
        return $this->xml->ReelList->Reel[$id] ?? null;
    }

    public function totalFrames(): int
    {
        $totalFrames = 0;
        foreach ($this->xml->ReelList as $reel) {
            // <Duration>164</Duration>
            $totalFrames += (int) $reel->Reel->AssetList->MainPicture->Duration;
        }

        return $totalFrames;
    }

    public function totalSeconds(): float
    {
        /*
        <MainPicture>
            <Id>urn:uuid:5e9f8cfd-76a4-4479-8065-66835a68f378</Id>
            <EditRate>24 1</EditRate>
            <IntrinsicDuration>164</IntrinsicDuration>
            <EntryPoint>0</EntryPoint>
            <Duration>164</Duration>
            <Hash>4gNNNEUvnjUACHVFnwaGe/wIav4=</Hash>
            <FrameRate>24 1</FrameRate>
            <ScreenAspectRatio>1.90</ScreenAspectRatio>
        </MainPicture>
         */
        $totalSeconds = 0;
        foreach ($this->xml->ReelList as $reel) {
            //           <Duration>164</Duration>
            $totalSeconds += (float) $reel->Reel->AssetList->MainPicture->Duration / DcpValues::parseFramerate((string) $reel->Reel->AssetList->MainPicture->FrameRate ?? '24');
        }

        return round($totalSeconds, 4);
    }
}
