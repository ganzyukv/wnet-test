<?php
declare(strict_types=1);

namespace App\Collection;

use App\Entity\Customer;
use ArrayIterator;
use IteratorAggregate;

class CustomerCollection implements IteratorAggregate
{
    private $customers;

    public function __construct(Customer ...$customers)
    {
        $this->customers = $customers;
    }

    /**
     * @param Customer $customer
     */
    public function addCustomer(Customer $customer): void
    {
        $this->customers[$customer->getIdCustomer()] = $customer;
    }

    /**
     * @param int $id_customer
     * @return Customer|null
     */
    public function getCustomer(int $id_customer): ?Customer
    {
        return $this->customers[$id_customer] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->customers);
    }
}