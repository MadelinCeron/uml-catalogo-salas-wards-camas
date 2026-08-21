<?php

namespace MicroHis\Domain;

enum BedStatus: string
{
    case AVAILABLE = 'disponible';
    case OCCUPIED = 'ocupada';
    case CLEANING = 'limpieza';
    case MAINTENANCE = 'mantenimiento';
}