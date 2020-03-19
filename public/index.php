<?php

namespace App;

use App\Component\Factory;
use Exception;
use Symfony\Component\Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require __DIR__ . '/../vendor/autoload.php';

(new Dotenv())->load(__DIR__ . '/../.env');

$loader = new FilesystemLoader(__DIR__ . '/../src/Template');

$twig = new Environment($loader);

$factory = new Factory();

if (!isset($_POST['form'])) {
    echo $twig->render('form.html.twig');
} else {
    $id_contract = (int)$_POST['contract'];
    $contractStatuses = $_POST['status'] ?? [];
    header('Content-Type: application/json');
    try {
        $documents = $factory->createDocument($id_contract, $contractStatuses);
        echo json_encode($documents);
    } catch (Exception $e) {
        echo json_encode([
            'error' => [
                'msg'  => $e->getMessage(),
                'code' => $e->getCode(),
            ],
        ]);
    }
}