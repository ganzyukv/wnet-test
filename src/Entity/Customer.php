<?php
declare(strict_types=1);

namespace App\Entity;

use App\Collection\ContractCollection;

final class Customer
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
    public function setCompany($company): string
    {
        $this->company = $company;
    }

    /**
     * @return int
     */
    public function getIdCustomer(): int
    {
        return (int)$this->id_customer;
    }

    /**
     * @param string $id_customer
     * @return string
     */
    public function setIdCustomer($id_customer): string
    {
        $this->id_customer = $id_customer;
    }

    public function getContract(int $id_contract): ?Contract
    {
        return $this->contracts->getContract($id_contract);
    }

    public function addContract(Contract $contract){
        $this->contracts->addContract($contract);
    }

    public function __set($name, $value)
    {
    }
}