<?php

namespace MicroHis\Application;

use MicroHis\Domain\Ward;
use MicroHis\Domain\Bed;
use MicroHis\Domain\BedStatus;
use InvalidArgumentException;

class CreateWardAndBed
{
    public function __construct(
        private WardRepository $wardRepository,
        private BedRepository $bedRepository
    ) {
    }

    public function execute(array $data): array
    {
        // 1. Crear la sala / Ward
        $ward = new Ward(
            null,
            $data['ward_name'] ?? '',
            $data['floor'] ?? null,
            $data['building'] ?? null
        );

        // 2. Guardar Ward
        $savedWard = $this->wardRepository->save($ward);

        if ($savedWard->getId() === null) {
            throw new \RuntimeException(
                'No fue posible obtener el ID del Ward.'
            );
        }

        // 3. Validar estado operativo
        $status = BedStatus::tryFrom(
            $data['bed_status'] ?? ''
        );

        if ($status === null) {
            throw new InvalidArgumentException(
                'El estado operativo de la cama no es válido.'
            );
        }

        $bedCode = trim($data['bed_code'] ?? '');

        if ($bedCode === '') {
            throw new InvalidArgumentException(
                'El código de la cama es obligatorio.'
            );
        }

        // 4. Comprobar código repetido dentro del Ward
        if (
            $this->bedRepository->codeExistsInWard(
                $savedWard->getId(),
                $bedCode
            )
        ) {
            throw new InvalidArgumentException(
                'Ya existe una cama con ese código dentro del Ward.'
            );
        }

        // 5. Crear cama
        $bed = new Bed(
            null,
            $savedWard->getId(),
            $bedCode,
            $status,
            $data['notes'] ?? null
        );

        // 6. Guardar cama
        $savedBed = $this->bedRepository->save($bed);

        return [
            'ward' => $savedWard,
            'bed' => $savedBed
        ];
    }
}