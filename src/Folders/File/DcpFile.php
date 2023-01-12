<?php

namespace Brightfish\DcpToolkit\Folders\File;

abstract class DcpFile
{
    public string $name;
    public string $path;
    public Type $type;
    public int $bytes;

}
