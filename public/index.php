<?php

namespace App;

use App\Component\Factory;
use Symfony\Component\Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require __DIR__ . '/../vendor/autoload.php';

(new Dotenv())->load(__DIR__ . '/../.env');

$loader = new FilesystemLoader(__DIR__ . '/../src/Template');

$twig = new Environment($loader);

$factory = new Factory();

$documents = $factory->createDocuments(202, 196, 200);

echo $twig->render('index.html.twig', ['customers' => $documents]);
