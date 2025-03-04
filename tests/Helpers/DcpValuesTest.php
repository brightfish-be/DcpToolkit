<?php

namespace Brightfish\DcpToolkit\Tests\Helpers;

use Brightfish\DcpToolkit\Helpers\DcpValues;

test('parse framerate', function () {
    expect(DcpValues::parseFramerate('24 1'))->toBe(24.0)
        ->and(DcpValues::parseFramerate('24000 1000'))->toBe(24.0);
});
