<?php
declare(strict_types=1);

namespace App\Entity;

use JsonSerializable;

final class Service implements JsonSerializable
{
    const STATUS_WORK = 'work';
    const STATUS_CONNECTING = 'connecting';
    const STATUS_DISCONNECTED = 'disconnected';

    protected $id_service;
    protected $id_contract;
    protected $title_service;
    protected $status;

    /**
     * @return int
     */
    public function getIdService(): int
    {
        return (int)$this->id_service;
    }

    /**
     * @param int $id_service
     */
    public function setIdService(int $id_service): void
    {
        $this->id_service = $id_service;
    }

    /**
     * @return int
     */
    public function getIdContract(): int
    {
        return (int)$this->id_contract;
    }

    /**
     * @param mixed $id_contract
     */
    public function setIdContract($id_contract): void
    {
        $this->id_contract = $id_contract;
    }

    /**
     * @return string
     */
    public function getTitleService(): string
    {
        return $this->title_service;
    }

    /**
     * @param string $title_service
     */
    public function setTitleService(string $title_service): void
    {
        $this->title_service = $title_service;
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
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function __set($name, $value)
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'id_service' => $this->getIdService(),
            'id_contract' =>$this->getIdContract(),
            'status' =>$this->getStatus(),
            'title_service' =>$this->getTitleService(),
        ];
    }
}