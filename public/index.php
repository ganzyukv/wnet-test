<?php

namespace App;

use App\Component\Factory;
use Symfony\Component\Dotenv\Dotenv;

include_once __DIR__ . '/../vendor/autoload.php';

(new Dotenv())->load(__DIR__ . '/../.env');

$factory = new Factory();

$documents = $factory->getCustomerByContractId(200);
dump($documents);

