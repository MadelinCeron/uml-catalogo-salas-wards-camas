<?php

use MicroHis\Application\BedRepository;
use MicroHis\Application\CreateWardAndBed;
use MicroHis\Application\WardRepository;
use MicroHis\Domain\Bed;
use MicroHis\Domain\Ward;

require_once __DIR__ . '/../src/Domain/BedStatus.php';
require_once __DIR__ . '/../src/Domain/Ward.php';
require_once __DIR__ . '/../src/Domain/Bed.php';

require_once __DIR__ . '/../src/Application/WardRepository.php';
require_once __DIR__ . '/../src/Application/BedRepository.php';
require_once __DIR__ . '/../src/Application/CreateWardAndBed.php';

$failed = 0;

function assertTrue(bool $condition, string $message): void
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

function test(string $name, callable $callback): void
{
    global $failed;

    try {
        $callback();
        echo "[OK] $name" . PHP_EOL;
    } catch (Throwable $e) {
        $failed++;
        echo "[FAIL] $name: " . $e->getMessage() . PHP_EOL;
    }
}

/*
|--------------------------------------------------------------------------
| PRUEBA 1 - CAMINO FELIZ
|--------------------------------------------------------------------------
*/

test('Camino feliz: crea Ward y cama correctamente', function () {

    $wardRepository = new class implements WardRepository {

        public function save(Ward $ward): Ward
        {
            return new Ward(
                1,
                $ward->getName(),
                $ward->getFloor(),
                $ward->getBuilding()
            );
        }
    };

    $bedRepository = new class implements BedRepository {

        public function codeExistsInWard(
            int $wardId,
            string $code
        ): bool {
            return false;
        }

        public function save(Bed $bed): Bed
        {
            return new Bed(
                1,
                $bed->getWardId(),
                $bed->getCode(),
                $bed->getStatus(),
                $bed->getNotes()
            );
        }
    };

    $useCase = new CreateWardAndBed(
        $wardRepository,
        $bedRepository
    );

    $result = $useCase->execute([
        'ward_name' => 'Pediatría',
        'floor' => '2',
        'building' => 'A',
        'bed_code' => 'PED-01',
        'bed_status' => 'disponible',
        'notes' => 'Dato ficticio'
    ]);

    assertTrue(
        $result['ward']->getName() === 'Pediatría',
        'El Ward no fue creado correctamente.'
    );

    assertTrue(
        $result['bed']->getCode() === 'PED-01',
        'La cama no fue creada correctamente.'
    );

    assertTrue(
        $result['bed']->getStatus()->value === 'disponible',
        'El estado de la cama no es correcto.'
    );
});


/*
|--------------------------------------------------------------------------
| PRUEBA 2 - REGLA DE DOMINIO
|--------------------------------------------------------------------------
*/

test('Regla de dominio: Ward requiere nombre', function () {

    try {

        new Ward(
            null,
            '   ',
            '2',
            'A'
        );

        throw new RuntimeException(
            'Se permitió crear un Ward sin nombre.'
        );

    } catch (InvalidArgumentException $e) {

        assertTrue(
            $e->getMessage() ===
            'El nombre de la sala / Ward es obligatorio.',
            'El mensaje de validación no es el esperado.'
        );
    }
});


/*
|--------------------------------------------------------------------------
| PRUEBA 3 - ERROR DE PERSISTENCIA
|--------------------------------------------------------------------------
*/

test('Error de persistencia: falla al guardar Ward', function () {

    $wardRepository = new class implements WardRepository {

        public function save(Ward $ward): Ward
        {
            throw new RuntimeException(
                'Error simulado de persistencia.'
            );
        }
    };

    $bedRepository = new class implements BedRepository {

        public function codeExistsInWard(
            int $wardId,
            string $code
        ): bool {
            return false;
        }

        public function save(Bed $bed): Bed
        {
            return $bed;
        }
    };

    $useCase = new CreateWardAndBed(
        $wardRepository,
        $bedRepository
    );

    try {

        $useCase->execute([
            'ward_name' => 'Emergencias',
            'floor' => '1',
            'building' => 'B',
            'bed_code' => 'EME-01',
            'bed_status' => 'disponible'
        ]);

        throw new RuntimeException(
            'La prueba esperaba un error de persistencia.'
        );

    } catch (RuntimeException $e) {

        assertTrue(
            $e->getMessage() ===
            'Error simulado de persistencia.',
            'No se recibió el error esperado.'
        );
    }
});


echo PHP_EOL;

if ($failed === 0) {

    echo "Todas las pruebas pasaron correctamente." . PHP_EOL;
    exit(0);

}

echo "$failed prueba(s) fallaron." . PHP_EOL;
exit(1);

test('Regla: no permite código de cama duplicado', function () {

    $wardRepository = new class implements WardRepository {

        public function save(Ward $ward): Ward
        {
            return new Ward(
                1,
                $ward->getName(),
                $ward->getFloor(),
                $ward->getBuilding()
            );
        }
    };

    $bedRepository = new class implements BedRepository {

        public function codeExistsInWard(
            int $wardId,
            string $code
        ): bool {
            return true;
        }

        public function save(Bed $bed): Bed
        {
            return $bed;
        }
    };

    $useCase = new CreateWardAndBed(
        $wardRepository,
        $bedRepository
    );

    try {

        $useCase->execute([
            'ward_name' => 'Pediatría',
            'floor' => '2',
            'building' => 'A',
            'bed_code' => 'PED-01',
            'bed_status' => 'disponible'
        ]);

        throw new RuntimeException(
            'Se permitió registrar una cama duplicada.'
        );

    } catch (InvalidArgumentException $e) {

        assertTrue(
            $e->getMessage() ===
            'Ya existe una cama con ese código dentro del Ward.',
            'No se recibió el mensaje esperado.'
        );
    }
});
test('Regla: rechaza estado operativo inválido', function () {

    $wardRepository = new class implements WardRepository {

        public function save(Ward $ward): Ward
        {
            return new Ward(
                1,
                $ward->getName(),
                $ward->getFloor(),
                $ward->getBuilding()
            );
        }
    };

    $bedRepository = new class implements BedRepository {

        public function codeExistsInWard(
            int $wardId,
            string $code
        ): bool {
            return false;
        }

        public function save(Bed $bed): Bed
        {
            return $bed;
        }
    };

    $useCase = new CreateWardAndBed(
        $wardRepository,
        $bedRepository
    );

    try {

        $useCase->execute([
            'ward_name' => 'Emergencias',
            'floor' => '1',
            'building' => 'A',
            'bed_code' => 'EME-01',
            'bed_status' => 'dañada'
        ]);

        throw new RuntimeException(
            'Se permitió un estado operativo inválido.'
        );

    } catch (InvalidArgumentException $e) {

        assertTrue(
            $e->getMessage() ===
            'El estado operativo de la cama no es válido.',
            'No se recibió el mensaje esperado.'
        );
    }
});