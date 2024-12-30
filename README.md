# PHP Package to read and write DCP Digital Cinema packages

[![Latest Version on Packagist](https://img.shields.io/packagist/v/brightfish/dcptoolkit.svg?style=flat-square)](https://packagist.org/packages/brightfish/dcptoolkit)
[![Tests](https://github.com/brightfish-be/DcpToolkit/actions/workflows/run-tests.yml/badge.svg)](https://github.com/brightfish-be/DcpToolkit/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/brightfish/dcptoolkit.svg?style=flat-square)](https://packagist.org/packages/brightfish/dcptoolkit)



## Installation

You can install the package via composer:

```bash
composer require brightfish/dcptoolkit
```

## Usage

```php
use Brightfish\DcpToolkit\Folders\AnalyzeDcp;

$dcp = AnalyzeDcp::simple($inputFolder);

/*
 * Brightfish\DcpToolkit\Folders\File\SimpleDcp Object
(
    [cplFile] => Brightfish\DcpToolkit\Folders\File\DcpFile Object
        (
            [name] => cpl_f2d8589c-b42e-4a99-8fca-9d992f7c77c3.xml
            [path] => [folder]/cpl_f2d8589c-b42e-4a99-8fca-9d992f7c77c3.xml
            [type] => Brightfish\DcpToolkit\Folders\File\Type Enum
                (
                    [name] => CPL
                )

            [bytes] => 16253
        )

    [pklFile] => Brightfish\DcpToolkit\Folders\File\DcpFile Object
        (
            [name] => pkl_b61c6bff-7dce-454d-af3a-e92f285e19af.xml
            [path] => [folder]/pkl_b61c6bff-7dce-454d-af3a-e92f285e19af.xml
            [type] => Brightfish\DcpToolkit\Folders\File\Type Enum
                (
                    [name] => PKL
                )

            [bytes] => 8957
        )

    [AssetMap] => Brightfish\DcpToolkit\Folders\File\DcpFile Object
        (
            [name] => ASSETMAP.xml
            [path] => [folder]/ASSETMAP.xml
            [type] => Brightfish\DcpToolkit\Folders\File\Type Enum
                (
                    [name] => MAP
                )

            [bytes] => 1825
        )

    [mxfAudio] => Brightfish\DcpToolkit\Folders\File\DcpFile Object
        (
            [name] => pcm_20631b02-f23c-4422-91fc-f891228d0782.mxf
            [path] => [folder]/pcm_20631b02-f23c-4422-91fc-f891228d0782.mxf
            [type] => Brightfish\DcpToolkit\Folders\File\Type Enum
                (
                    [name] => Sound
                )

            [bytes] => 25986426
        )

    [mxfVideo] => Brightfish\DcpToolkit\Folders\File\DcpFile Object
        (
            [name] => j2c_cf1893bf-b994-4552-b704-f65bb2abc7c6.mxf
            [path] => [folder]/j2c_cf1893bf-b994-4552-b704-f65bb2abc7c6.mxf
            [type] => Brightfish\DcpToolkit\Folders\File\Type Enum
                (
                    [name] => Picture
                )

            [bytes] => 688606846
        )

)
 */
```

## Testing

```bash
composer test
```

## Credits

- [Peter Forret @ BF](https://github.com/brightfish-be)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
