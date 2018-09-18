<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Helpers\Tests;

use PHPUnit\Framework\TestCase;
use Spiral\Helpers\Serializer;

class SerializerTest extends TestCase
{
    /**
     * @var Serializer|null
     */
    private $serializer = null;

    /**
     * Set custom serializer.
     *
     * @param Serializer $serializer
     */
    public function setSerializer(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Associated serializer.
     *
     * @return Serializer
     */
    private function getSerializer(): Serializer
    {
        return $this->serializer ?? ($this->serializer = new Serializer());
    }

    public function setUp()
    {
        $this->setSerializer(new Serializer());
    }

    public function testEmptyArray()
    {
        $this->assertSame('[]', $this->getSerializer()->serialize([]));
    }

    public function testArrayOfArray()
    {
        $this->assertEquals(preg_replace('/\s+/', '',
            '[
    \'hello\' => [
        \'name\' => 123
    ]
]'), preg_replace('/\s+/', '', $this->getSerializer()->serialize([
            'hello' => ['name' => 123]
        ])));
    }

    public function testClassNames()
    {
        $this->assertEquals(preg_replace('/\s+/', '',
            '[
    \'hello\' => [
        \'name\' => 123,
        \'sub\'  => \Spiral\Helpers\Serializer::class
    ]
]'), preg_replace('/\s+/', '', $this->getSerializer()->serialize([
            'hello' => ['name' => 123, 'sub' => Serializer::class]
        ])));
    }
}