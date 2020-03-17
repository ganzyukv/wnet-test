<?php
declare(strict_types=1);

namespace App\Collection;

use App\Entity\Contract;
use ArrayIterator;
use IteratorAggregate;

class ContractCollection implements IteratorAggregate
{
    private $contracts;

    public function __construct(Contract ...$contract)
    {
        $this->contracts = $contract;
    }

    /**
     * @param Contract $contract
     */
    public function addContract(Contract $contract): void
    {
        $this->contracts[$contract->getIdContract()] = $contract;
    }

    /**
     * @param int $id_contract
     * @return Contract|null
     */
    public function getContract(int $id_contract): ?Contract
    {
        return $this->contracts[$id_contract] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->contracts);
    }
}