<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Helpers\Tests;

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    public function testInterpolate()
    {
        $result = interpolate("Hello {name}", ['name' => 'Anton']);
        $this->assertSame('Hello Anton', $result);
    }

    public function testInterpolateCustomBraces()
    {
        $result = interpolate("Hello [name]", ['name' => 'Anton'], '[', ']');
        $this->assertSame('Hello Anton', $result);
    }
}