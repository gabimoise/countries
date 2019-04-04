<?php
declare(strict_types=1);

namespace Yas;

use Yas\Repository\DataManager;
use Yas\Service\Config;
use Yas\Service\ProcessorFactory;

$autoloader = require __DIR__ . '/vendor/autoload.php';
$autoloader->addPsr4('Yas\\', __DIR__);

try {
    $processor = ProcessorFactory::getProcessor($argv);

    $dataManager = new DataManager(Config::getDataProvider());
    $processor->setDataManager($dataManager);
    echo $processor->process();
} catch (\Throwable $exception) {
    echo $exception->getMessage();
}
