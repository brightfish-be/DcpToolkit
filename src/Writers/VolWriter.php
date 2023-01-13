<?php

namespace Brightfish\DcpToolkit\Writers;

use Brightfish\DcpToolkit\Exceptions\InputMissingException;

class VolWriter extends BaseWriter
{
    /**
     * @throws InputMissingException
     */
    public function __construct()
    {
        parent::__construct();
        $this->loadFromTemplate('VolumeIndex');
    }
}
