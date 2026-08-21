<?php

namespace MicroHis\Persistence;

use MicroHis\Application\WardRepository;
use MicroHis\Domain\Ward;
use PDO;

class PdoWardRepository implements WardRepository
{
    public function __construct(
        private PDO $pdo
    ) {
    }

    public function save(Ward $ward): Ward
    {
        $sql = '
            INSERT INTO wards (name, floor, building)
            VALUES (:name, :floor, :building)
        ';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':name' => $ward->getName(),
            ':floor' => $ward->getFloor(),
            ':building' => $ward->getBuilding()
        ]);

        return new Ward(
            (int) $this->pdo->lastInsertId(),
            $ward->getName(),
            $ward->getFloor(),
            $ward->getBuilding()
        );
    }
}