<?php

namespace Days85\Nicehash\Tests\Unit\Models\Requests;

use Days85\Nicehash\Models\Requests\MiningRigsPayoutsParams;
use Days85\Nicehash\Tests\TestCase;

class MiningRigsPayoutsParamsTest extends TestCase
{
    public function testToArray()
    {
        $expected = [
            'beforeTimestamp' => 111111,
            'size' => 13,
            'page' => 2,
        ];

        $params = new MiningRigsPayoutsParams($expected);

        $this->assertEquals($expected, $params->toArray());
    }

    public function testToArrayWithNull()
    {
        $expected = [
            'beforeTimestamp' => null,
            'size' => 13,
            'page' => 2,
        ];

        $params = new MiningRigsPayoutsParams($expected);

        unset($expected['beforeTimestamp']);

        $this->assertEquals($expected, $params->toArray());
    }
}
