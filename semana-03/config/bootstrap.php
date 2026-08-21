<?php

use MicroHis\Application\CreateWardAndBed;
use MicroHis\Persistence\PdoBedRepository;
use MicroHis\Persistence\PdoWardRepository;
use MicroHis\Presentation\WardBedController;

// Domain
require_once __DIR__ . '/../src/Domain/BedStatus.php';
require_once __DIR__ . '/../src/Domain/Ward.php';
require_once __DIR__ . '/../src/Domain/Bed.php';

// Application
require_once __DIR__ . '/../src/Application/WardRepository.php';
require_once __DIR__ . '/../src/Application/BedRepository.php';
require_once __DIR__ . '/../src/Application/CreateWardAndBed.php';

// Persistence
require_once __DIR__ . '/../src/Persistence/PdoWardRepository.php';
require_once __DIR__ . '/../src/Persistence/PdoBedRepository.php';

// Presentation
require_once __DIR__ . '/../src/Presentation/WardBedController.php';

$config = require __DIR__ . '/database.php';

$pdo = new PDO($config['dsn']);

$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);

$pdo->exec('PRAGMA foreign_keys = ON');

$wardRepository = new PdoWardRepository($pdo);
$bedRepository = new PdoBedRepository($pdo);

$useCase = new CreateWardAndBed(
    $wardRepository,
    $bedRepository
);

return new WardBedController($useCase);