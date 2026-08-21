<?php

$config = require __DIR__ . '/../config/database.php';

$pdo = new PDO($config['dsn']);

$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);

$pdo->exec('PRAGMA foreign_keys = ON');

$schema = file_get_contents(
    __DIR__ . '/schema.sql'
);

$pdo->exec($schema);

echo "Base de datos creada correctamente." . PHP_EOL;