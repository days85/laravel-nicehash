<?php

namespace Days85\Nicehash\Tests\Unit\Models\Requests;

use Days85\Nicehash\Models\Requests\MiningRigsParams;
use Days85\Nicehash\Tests\TestCase;

class MiningRigsParamsTest extends TestCase
{
    public function testToArray()
    {
        $expected = [
            'size' => 13,
            'page' => 2,
            'path' => 'example/path',
            'sort' => 'NAME',
            'system' => 'NHOS',
            'status' => 'Mining'
        ];

        $params = new MiningRigsParams($expected);

        $this->assertEquals($expected, $params->toArray());
    }

    public function testToArrayWithNull()
    {
        $expected = [
            'size' => null,
            'page' => null,
            'path' => 'example/path',
            'sort' => 'NAME',
            'system' => 'NHOS',
            'status' => 'Mining'
        ];

        $params = new MiningRigsParams($expected);

        unset($expected['size']);
        unset($expected['page']);

        $this->assertEquals($expected, $params->toArray());
    }
}
