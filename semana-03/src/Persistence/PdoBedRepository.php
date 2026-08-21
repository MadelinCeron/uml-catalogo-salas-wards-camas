<?php

namespace MicroHis\Persistence;

use MicroHis\Application\BedRepository;
use MicroHis\Domain\Bed;
use PDO;

class PdoBedRepository implements BedRepository
{
    public function __construct(
        private PDO $pdo
    ) {
    }

    public function codeExistsInWard(
        int $wardId,
        string $code
    ): bool {
        $sql = '
            SELECT COUNT(*)
            FROM beds
            WHERE ward_id = :ward_id
              AND code = :code
        ';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':ward_id' => $wardId,
            ':code' => $code
        ]);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function save(Bed $bed): Bed
    {
        $sql = '
            INSERT INTO beds (
                ward_id,
                code,
                status,
                notes
            )
            VALUES (
                :ward_id,
                :code,
                :status,
                :notes
            )
        ';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':ward_id' => $bed->getWardId(),
            ':code' => $bed->getCode(),
            ':status' => $bed->getStatus()->value,
            ':notes' => $bed->getNotes()
        ]);

        return new Bed(
            (int) $this->pdo->lastInsertId(),
            $bed->getWardId(),
            $bed->getCode(),
            $bed->getStatus(),
            $bed->getNotes()
        );
    }
}