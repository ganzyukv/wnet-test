<?php
declare(strict_types=1);

namespace App\Service;

use mysqli;
use RuntimeException;

final class DBService
{
    private static $instance;
    private $connection;
    /**
     * @var $result \mysqli_result
     */
    private $result;

    protected function __construct()
    {
        $this->connection = new mysqli($_ENV['MYSQL_HOST'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE'], (int)$_ENV['MYSQL_PORT']);
        if ($this->connection->connect_error) {
            throw new RuntimeException($this->connection->connect_error);
        }
    }

    public static function getInstance(): self
    {
        return static::$instance ?? static::$instance = new static();
    }

    public function query($query): self
    {
        $this->result = $this->connection->query($query);
        return $this;
    }

    /**
     * @param string $className
     * @return \stdClass|object|null
     */
    public function fetch_object(string $className = 'stdClass'): object
    {
        return $this->result->fetch_object($className);
    }

}