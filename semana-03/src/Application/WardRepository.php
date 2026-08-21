<?php

namespace MicroHis\Application;

use MicroHis\Domain\Ward;

interface WardRepository
{
    public function save(Ward $ward): Ward;
}