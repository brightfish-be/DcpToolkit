<?php

namespace Brightfish\DcpToolkit\Writers;

use Brightfish\DcpToolkit\Exceptions\InputInvalidException;
use Brightfish\DcpToolkit\Helpers\CplTime;
use Brightfish\DcpToolkit\Helpers\CplUuid;

class CplWriter extends BaseWriter
{
    public function rename(string $name)
    {
        $this->contents->AnnotationText = $name;
        $this->contents->ContentTitleText = $name;
        $this->contents->Id = CplUuid::prefix4();
        $this->contents->IssueDate = CplTime::now();
        $this->contents->Issuer = $this->Issuer;
        $this->contents->Creator = $this->Creator;
    }

    /**
     * @throws InputInvalidException
     */
    public function calculateCplDigest(): string
    {
        $digest_length = 3;
        if (! isset($this->contents)) {
            throw new InputInvalidException('No contents to analyze');
        }
        $idList = [];
        foreach ($this->contents->ReelList->Reel as $reel) {
            $id = (string) $reel->Id;
            $idList[$id] = $id;
        }
        sort($idList);
        $idListTxt = implode(',', $idList);

        return sprintf('%03d%s', count($idList), strtoupper(substr(sha1($idListTxt), 0, $digest_length)));
    }
}
