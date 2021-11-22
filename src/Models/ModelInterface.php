<?php

namespace Days85\Nicehash\Models;

interface ModelInterface
{
    /**
     * @param $data
     * @return static
     */
    public function fromArray($data): static;

    /**
     * @return void
     */
    public function reset(): void;
}
