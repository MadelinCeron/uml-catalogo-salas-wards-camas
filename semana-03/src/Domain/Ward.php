<?php

namespace MicroHis\Domain;

class Ward
{
    public function __construct(
        private ?int $id,
        private string $name,
        private ?string $floor = null,
        private ?string $building = null
    ) {
        if (trim($name) === '') {
            throw new \InvalidArgumentException(
                'El nombre de la sala / Ward es obligatorio.'
            );
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function getBuilding(): ?string
    {
        return $this->building;
    }
}