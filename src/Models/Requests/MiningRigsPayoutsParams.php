<?php

namespace Days85\Nicehash\Models\Requests;

class MiningRigsPayoutsParams implements RequestParamsInterface
{
    /**
     * @var int
     */
    protected int $beforeTimestamp;

    /**
     * @var int
     */
    protected int $size;

    /**
     * @var int
     */
    protected int $page;

    /**
     * @param array $params
     */
    public function __construct(array $params)
    {
        if (isset($params['beforeTimestamp'])) {
            $this->setBeforeTimestamp($params['beforeTimestamp']);
        }

        if (isset($params['size'])) {
            $this->setSize($params['size']);
        }

        if (isset($params['page'])) {
            $this->setPage($params['page']);
        }
    }

    /**
     * @return int
     */
    public function getBeforeTimestamp(): int
    {
        return $this->beforeTimestamp;
    }

    /**
     * @param int $beforeTimestamp
     * @return MiningRigsPayoutsParams
     */
    public function setBeforeTimestamp(int $beforeTimestamp): MiningRigsPayoutsParams
    {
        $this->beforeTimestamp = $beforeTimestamp;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return MiningRigsPayoutsParams
     */
    public function setSize(int $size): MiningRigsPayoutsParams
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return MiningRigsPayoutsParams
     */
    public function setPage(int $page): MiningRigsPayoutsParams
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
