<?php

namespace MicroHis\Domain;

class Bed
{
    public function __construct(
        private ?int $id,
        private int $wardId,
        private string $code,
        private BedStatus $status,
        private ?string $notes = null
    ) {
        if ($wardId <= 0) {
            throw new \InvalidArgumentException(
                'La cama debe pertenecer a una sala / Ward válida.'
            );
        }

        if (trim($code) === '') {
            throw new \InvalidArgumentException(
                'El código de la cama es obligatorio.'
            );
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWardId(): int
    {
        return $this->wardId;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getStatus(): BedStatus
    {
        return $this->status;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function changeStatus(BedStatus $newStatus): void
    {
        $this->status = $newStatus;
    }
}