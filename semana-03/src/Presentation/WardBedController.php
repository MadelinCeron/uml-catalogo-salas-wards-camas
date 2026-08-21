<?php

namespace MicroHis\Presentation;

use MicroHis\Application\CreateWardAndBed;
use Throwable;

class WardBedController
{
    public function __construct(
        private CreateWardAndBed $createWardAndBed
    ) {
    }

    public function store(array $data): array
    {
        try {
            $result = $this->createWardAndBed->execute($data);

            return [
                'success' => true,
                'message' => 'Sala y cama registradas correctamente.',
                'ward' => $result['ward'],
                'bed' => $result['bed'],
            ];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}