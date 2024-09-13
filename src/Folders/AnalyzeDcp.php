<?php

namespace Brightfish\DcpToolkit\Folders;

use Brightfish\DcpToolkit\Exceptions\InputMissingException;
use Brightfish\DcpToolkit\Folders\File\DcpFile;
use Brightfish\DcpToolkit\Folders\File\SimpleDcp;
use Brightfish\DcpToolkit\Folders\File\Type;

class AnalyzeDcp
{
    /**
     * @throws InputMissingException
     */
    public static function simple(string $folder): SimpleDcp
    {
        if (! is_dir($folder)) {
            throw new InputMissingException("Folder not found: [$folder]");
        }

        $dcp = new SimpleDcp;
        $files = glob("$folder/*");
        foreach ($files as $file) {
            $dcpFile = new DcpFile;
            $dcpFile->path = realpath($file);
            $dcpFile->name = basename($file);
            $dcpFile->bytes = filesize($file);
            $dcpFile->type = self::detectType($dcpFile);
            switch ($dcpFile->type) {
                case Type::CPL:
                    $dcp->cplFile = $dcpFile;
                    break;
                case Type::PKL:
                    $dcp->pklFile = $dcpFile;
                    break;
                case Type::MAP:
                    $dcp->AssetMap = $dcpFile;
                    break;
                case Type::Sound:
                    $dcp->mxfAudio = $dcpFile;
                    break;
                case Type::Picture:
                    $dcp->mxfVideo = $dcpFile;
                    break;
                case Type::VOL:
                    $dcp->VolIndex = $dcpFile;
                    break;
                case Type::UNKNOWN: // do nothing;
            }
        }

        return $dcp;
    }

    private static function detectType(DcpFile $dcpFile): Type
    {
        if ($dcpFile->name === 'ASSETMAP') {
            return Type::MAP;
        }
        if ($dcpFile->name === 'VOLINDEX') {
            return Type::VOL;
        }
        $extension = strtolower(pathinfo($dcpFile->name, PATHINFO_EXTENSION));
        if ($extension === 'mxf') {
            if (stripos($dcpFile->name, 'audio') !== false) {
                return Type::Sound;
            }
            if (stripos($dcpFile->name, 'sound') !== false) {
                return Type::Sound;
            }
            if (stripos($dcpFile->name, 'wav') !== false) {
                return Type::Sound;
            }
            if (stripos($dcpFile->name, 'pcm') !== false) {
                return Type::Sound;
            }
            if (stripos($dcpFile->name, 'video') !== false) {
                return Type::Picture;
            }
            if (stripos($dcpFile->name, 'image') !== false) {
                return Type::Picture;
            }
            if (stripos($dcpFile->name, 'j2c') !== false) {
                return Type::Picture;
            }

            return Type::UNKNOWN;
        }
        if ($extension === 'cpl') {
            return Type::CPL;
        }
        if ($extension === 'pkl') {
            return Type::PKL;
        }
        if ($extension === 'xml') {
            if (stripos($dcpFile->name, 'CPL') !== false) {
                return Type::CPL;
            }
            if (stripos($dcpFile->name, 'ASSETMAP') !== false) {
                return Type::MAP;
            }
            if (stripos($dcpFile->name, 'PKL') !== false) {
                return Type::PKL;
            }
            $contents = file_get_contents($dcpFile->path);
            if (strstr($contents, 'CompositionPlaylist') !== '') {
                return Type::CPL;
            }
            if (strstr($contents, 'PackingList') !== '') {
                return Type::PKL;
            }
        }

        return Type::UNKNOWN;
    }
}
