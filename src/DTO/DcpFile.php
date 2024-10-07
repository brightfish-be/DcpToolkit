<?php

namespace Brightfish\DcpToolkit\DTO;

use Brightfish\DcpToolkit\Enums\Type;

class DcpFile
{
    public string $name;

    public string $path;

    public Type $type;

    public int $bytes;
}
