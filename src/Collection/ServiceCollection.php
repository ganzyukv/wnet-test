<?php
declare(strict_types=1);

namespace App\Collection;

use App\Entity\Service;
use ArrayIterator;
use IteratorAggregate;
use JsonSerializable;

class ServiceCollection implements IteratorAggregate, JsonSerializable
{

    private $services;

    public function __construct(Service ...$services)
    {
        $this->services = $services;
    }

    /**
     * @param Service $service
     */
    public function addService(Service $service): void
    {
        $this->services[$service->getIdService()] = $service;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->services);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->services;
    }
}