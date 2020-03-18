<?php
declare(strict_types=1);

namespace App\Entity;

use App\Collection\ContractCollection;
use JsonSerializable;

final class Customer implements JsonSerializable
{
    const COMPANY_1 = 'company_1';
    const COMPANY_2 = 'company_2';
    const COMPANY_3 = 'company_3';

    private $id_customer;
    private $name_customer;
    private $company;
    private $contracts;

    /**
     * Customer constructor.
     */
    public function __construct()
    {
        $this->contracts = new ContractCollection();
    }

    public function getContract(int $id_contract): ?Contract
    {
        return $this->contracts->getContract($id_contract);
    }

    public function addContract(Contract $contract)
    {
        $this->contracts->addContract($contract);
    }

    public function __set($name, $value)
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'id_customer'   => $this->getIdCustomer(),
            'id_company'    => $this->getCompany(),
            'name_customer' => $this->getNameCustomer(),
            'contracts'     => $this->getContracts(),
        ];
    }

    /**
     * @return int
     */
    public function getIdCustomer(): int
    {
        return (int)$this->id_customer;
    }

    /**
     * @param int $id_customer
     * @return string
     */
    public function setIdCustomer(int $id_customer): string
    {
        $this->id_customer = $id_customer;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return string
     */
    public function setCompany(string $company): string
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getNameCustomer(): string
    {
        return $this->name_customer;
    }

    /**
     * @param string $name_customer
     * @return string
     */
    public function setNameCustomer(string $name_customer): string
    {
        $this->name_customer = $name_customer;
    }

    /**
     * @return ContractCollection|Contract[]|null
     */
    public function getContracts(): ?ContractCollection
    {
        return $this->contracts;
    }
}