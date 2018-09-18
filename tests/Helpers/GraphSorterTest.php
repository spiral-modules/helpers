<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Helpers\Tests;

use PHPUnit\Framework\TestCase;
use Spiral\Helpers\GraphSorter;

class GraphSorterTest extends TestCase
{
    /**
     * @dataProvider stackProvider
     *
     * @param array $input
     * @param array $output
     */
    public function testSorter($input, $output)
    {
        $sorter = new GraphSorter();
        foreach ($input as $element => $dependencies) {
            $sorter->addItem($element, $element, $dependencies);
        }

        $this->assertEquals($output, $sorter->sort());
    }

    /**
     * @return array
     */
    public function stackProvider()
    {
        return [
            [
                [
                    'a' => ['c'],
                    'b' => ['a'],
                    'c' => [],
                ],
                ['c', 'a', 'b'],
            ],
            [
                [
                    'a' => ['c', 'b'],
                    'b' => ['c'],
                    'c' => [],
                ],
                ['c', 'b', 'a'],
            ],
            [
                [
                    'a' => ['c', 'b'],
                    'b' => ['c'],
                    'c' => [],
                    'd' => ['a'],
                ],
                ['c', 'b', 'a', 'd'],
            ],
        ];
    }
}