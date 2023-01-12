<?php

namespace Brightfish\DcpToolkit\Parsers;

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
}
