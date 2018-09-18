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

    public function testE()
    {
        $this->assertSame('', e('', true));
        $this->assertSame('', e($this, true));
        $this->assertSame('', e('', false));
        $this->assertSame('', e(null, false));
        $this->assertSame('hello', e('<b>hello</b>', true));
        $this->assertSame(
            '&lt;b&gt;hello&lt;/b&gt;',
            e('<b>hello</b>', false)
        );
    }

}