<?php
declare(strict_types=1);

namespace App\Entity;

use App\Collection\ServiceCollection;
use DateTime;
use JsonSerializable;

final class Contract implements JsonSerializable
{
    private $id_contract;
    private $id_customer;
    private $number;
    private $date_sign;
    private $staff_number;
    private $services;

    public function __construct()
    {
        $this->services = new ServiceCollection();
    }

    public function addService(Service $service): void
    {
        $this->services->addService($service);
    }

    public function __set($name, $value)
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'id_contract'  => $this->getIdContract(),
            'id_customer'  => $this->getIdCustomer(),
            'date_sign'    => $this->getDateSign(),
            'number'       => $this->getNumber(),
            'stuff_number' => $this->getStaffNumber(),
            'services'     => $this->getServices(),
        ];
    }

    /**
     * @return int
     */
    public function getIdContract(): int
    {
        return (int)$this->id_contract;
    }

    /**
     * @param int $id_contract
     */
    public function setIdContract(int $id_contract): void
    {
        $this->id_contract = $id_contract;
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
     */
    public function setIdCustomer(int $id_customer): void
    {
        $this->id_customer = $id_customer;
    }

    /**
     * @return mixed
     */
    public function getDateSign(): ?DateTime
    {
        return DateTime::createFromFormat('Y-m-d', $this->date_sign);
    }

    /**
     * @param string $date_sign
     */
    public function setDateSign(string $date_sign): void
    {
        $this->date_sign = DateTime::createFromFormat('Y-m-d', $date_sign);
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getStaffNumber(): string
    {
        return $this->staff_number;
    }

    /**
     * @param string $staff_number
     */
    public function setStaffNumber(string $staff_number): void
    {
        $this->staff_number = $staff_number;
    }

    /**
     * @return ServiceCollection|Service[]|null
     */
    public function getServices(): ?ServiceCollection
    {
        return $this->services;
    }
}