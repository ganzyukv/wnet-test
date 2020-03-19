<?php
declare(strict_types=1);

namespace App\Component;

use App\Collection\CustomerCollection;
use App\Entity\Customer;
use App\Exception\NotFoundHttpException;
use App\Repository\Repository;
use Exception;

final class Factory
{
    private $repository;
    private $customerCollection;

    public function __construct()
    {
        $this->repository = new Repository();
        $this->customerCollection = new CustomerCollection();
    }

    public function createDocument(int $id_contract, array $serviceStatus = []): ?Customer
    {
        $customer = $this->getCustomerByQuery(['id_contract' => $id_contract, 'status' => $serviceStatus]);
        return $customer ?? null;
    }

    private function getCustomerByQuery(array $query): ?Customer
    {
        $id_contract = $query['id_contract'];
        $id_customer = $this->repository->getCustomerId($id_contract);
        if (empty($id_customer)) {
            throw new NotFoundHttpException('Customer with contract not found');
        }
        $customer = $this->customerCollection->getCustomer($id_customer);

        if ($customer) {
            if (empty($customer->getContract($id_contract))) {
                $contract = $this->repository->findContractByQuery($query);
                $customer->addContract($contract);
            }
        } else {
            $customer = $this->repository->findCustomerByQuery($query);
            if (!$customer) {
                throw new NotFoundHttpException('Contract not found');
            }
            $this->customerCollection->addCustomer($customer);
        }

        return $customer;
    }


}