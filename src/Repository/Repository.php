<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Contract;
use App\Entity\Customer;
use App\Entity\Service;
use mysqli;
use RuntimeException;

final class Repository
{
    private $connection;
    private $result;

    public function __construct()
    {
        $this->connection = new mysqli($_ENV['MYSQL_HOST'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE'], (int)$_ENV['MYSQL_PORT']);
        if ($this->connection->connect_error) {
            throw new RuntimeException($this->connection->connect_error);
        }
    }

    public function getCustomerId(int $id_contract): ?int
    {
        $result = $this->connection->query("SELECT id_customer                                              
                                            FROM obj_contracts
                                            WHERE id_contract = $id_contract");
        $row = $result->fetch_object();

        return (int)$row->id_customer ?? null;

    }

    public function findContractByQuery(array $query): ?Contract
    {
        $this->getData($query);
        /** @var Contract $contract */
        $contract = $this->result->fetch_object(Contract::class);
        $this->result->data_seek(0);

        /** @var Service $service */
        while ($service = $this->result->fetch_object(Service::class)) {
            if ($service) {
                $contract->addService($service);
            }
        }
        return $contract;
    }

    private function getData(array $query)
    {

        $statusesArr = array_map(function ($value) {
            return "'" . $this->connection->escape_string($value) . "'";
        }, $query['status']);

        $statuses = implode(',', $statusesArr);
        $id_contract = (int)$query['id_contract'];
        $sqlWhere = '1';
        if (!empty($statuses)) {
            $sqlWhere .= ' AND status IN (' . $statuses . ')';
        }
        if (!empty($id_contract)) {
            $sqlWhere .= ' AND obj_services.id_contract = ' . $id_contract;
        }

        $sqlQuery = "SELECT obj_customers.*,
                            obj_contracts.id_contract,
                            number,
                            date_sign,
                            staff_number,
                            obj_services.*
                            FROM obj_contracts
                                        LEFT join obj_customers ON obj_customers.id_customer = obj_contracts.id_customer
                                        LEFT join obj_services ON obj_services.id_contract = obj_contracts.id_contract
                             WHERE obj_contracts.id_contract IN (SELECT obj_services.id_contract
                                                                 FROM obj_services 
                                                                 WHERE $sqlWhere)";
        $this->result = $this->connection->query($sqlQuery);
    }

    public function findCustomerByQuery(array $query): ?Customer
    {
        $this->getData($query);

        if (!$this->result->num_rows) {
            return null;
        }
        /** @var Customer $customer */
        $customer = $this->result->fetch_object(Customer::class);
        $this->result->data_seek(0);
        /** @var Contract $contract */
        $contract = $this->result->fetch_object(Contract::class);
        $this->result->data_seek(0);

        /** @var Service $service */
        while ($service = $this->result->fetch_object(Service::class)) {
            if ($service->getIdService()) {
                $contract->addService($service);
            }
        }

        if ($contract) {
            $customer->addContract($contract);
        }

        return $customer;
    }

}