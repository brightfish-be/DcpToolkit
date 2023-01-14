<?php

namespace Brightfish\DcpToolkit\Folders;

use Brightfish\DcpToolkit\Exceptions\InputMissingException;

class FindDcps
{
    /**
     * @throws InputMissingException
     */
    public static function find(string $folder, int $levels = 1): array
    {
        if (! is_dir($folder)) {
            throw new InputMissingException("Folder not found: [$folder]");
        }
        $dcpFolders = [];
        $output = [];
        exec("find \"$folder\" -maxdepth $levels -type f -name \"ASSETMAP*\"", $output);
        if ($output) {
            $dcpFolders = array_map(function ($value) {
            return realpath(dirname($value));
            }, $output);
        }

        return $dcpFolders;
    }
}
