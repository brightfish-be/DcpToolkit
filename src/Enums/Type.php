<?php

namespace Brightfish\DcpToolkit\Enums;

enum Type
{
    case Picture;       // <Type>application/x-smpte-mxf;asdcpKind=Picture</Type>
    case Sound;         // <Type>application/x-smpte-mxf;asdcpKind=Sound</Type>
    case CPL;           // <Type>text/xml;asdcpKind=CPL</Type>
    case PKL;           // <Type>text/xml;asdcpKind=PKL</Type>
    case MAP;           // ASSETMAP / Assetmap.xml
    case VOL;           // VOLINDEX
    case UNKNOWN;       // for other files
}
