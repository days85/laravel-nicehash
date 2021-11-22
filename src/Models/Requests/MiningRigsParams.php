<?php

namespace Days85\Nicehash\Models\Requests;

class MiningRigsParams implements RequestParamsInterface
{
    /**
     * @var int
     */
    protected int $size;

    /**
     * @var int
     */
    protected int $page;

    /**
     * @var string
     */
    protected string $path;

    /**
     * @var string
     */
    protected string $sort;

    /**
     * @var string
     */
    protected string $system;

    /**
     * @var string
     */
    protected string $status;

    /**
     * @param array $params
     */
    public function __construct(array $params)
    {
        if (isset($params['size'])) {
            $this->setSize($params['size']);
        }

        if (isset($params['page'])) {
            $this->setPage($params['page']);
        }

        if (isset($params['path'])) {
            $this->setPath($params['path']);
        }

        if (isset($params['sort'])) {
            $this->setSort($params['sort']);
        }

        if (isset($params['system'])) {
            $this->setSystem($params['system']);
        }

        if (isset($params['status'])) {
            $this->setStatus($params['status']);
        }
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
     * @return MiningRigsParams
     */
    public function setSize(int $size): MiningRigsParams
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
     * @return MiningRigsParams
     */
    public function setPage(int $page): MiningRigsParams
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return MiningRigsParams
     */
    public function setPath(string $path): MiningRigsParams
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getSort(): string
    {
        return $this->sort;
    }

    /**
     * @param string $sort
     * @return MiningRigsParams
     */
    public function setSort(string $sort): MiningRigsParams
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * @return string
     */
    public function getSystem(): string
    {
        return $this->system;
    }

    /**
     * @param string $system
     * @return MiningRigsParams
     */
    public function setSystem(string $system): MiningRigsParams
    {
        $this->system = $system;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return MiningRigsParams
     */
    public function setStatus(string $status): MiningRigsParams
    {
        $this->status = $status;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}