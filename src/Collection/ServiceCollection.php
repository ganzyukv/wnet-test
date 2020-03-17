<?php
declare(strict_types=1);

namespace App\Collection;

use App\Entity\Service;
use ArrayIterator;
use IteratorAggregate;

class ServiceCollection implements IteratorAggregate
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
}