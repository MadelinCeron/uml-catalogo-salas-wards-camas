<?php

namespace MicroHis\Application;

use MicroHis\Domain\Bed;

interface BedRepository
{
    public function save(Bed $bed): Bed;

    public function codeExistsInWard(int $wardId, string $code): bool;
}