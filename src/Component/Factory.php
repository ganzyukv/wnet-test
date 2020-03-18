<?php
declare(strict_types=1);

namespace App\Component;

use App\Collection\CustomerCollection;
use App\Entity\Customer;
use App\Repository\Repository;

final class Factory
{
    private $repository;
    private $customerCollection;

    public function __construct()
    {
        $this->repository = new Repository();
        $this->customerCollection = new CustomerCollection();
    }

    public function createDocuments(...$ids){
        foreach ($ids as $id){
            if(!is_integer($id)){
                throw new \InvalidArgumentException('Argument id must be is integer');
            }
            $customer = $this->getCustomerByContractId($id);
            $documents[$customer->getIdCustomer()] = $customer;
        }
        return $documents ?? null;
    }

    private function getCustomerByContractId(int $id_contract): ?Customer
    {
        $id_customer = $this->repository->getCustomerId($id_contract);
        $customer = $this->customerCollection->getCustomer($id_customer);

        if ($customer) {
            if (empty($customer->getContract($id_contract))) {
                $contract = $this->repository->findContract($id_contract);
                $customer->addContract($contract);
            }
        } else {
            $customer = $this->repository->findCustomerByContractId($id_contract);
            $this->customerCollection->addCustomer($customer);
        }

        return $customer;
    }


}