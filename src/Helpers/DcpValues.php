<?php

namespace Brightfish\DcpToolkit\Helpers;

class DcpValues
{
    public static function parseFramerate(string $FrameRate): float
    {
        $FrameRate = trim($FrameRate);
        switch (true) {
            case preg_match('/^\d+\s\d+$/', $FrameRate):
                [$frames, $second] = explode(' ', $FrameRate);
                $fps = (float) $frames / (float) $second;
                break;
            default:
                $fps = (float) $FrameRate;
        }

        return round($fps, 3);
    }
}
