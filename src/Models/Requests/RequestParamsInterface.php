<?php

namespace Days85\Nicehash\Models\Requests;

interface RequestParamsInterface
{
    /**
     * @return array
     */
    public function toArray(): array;
}
