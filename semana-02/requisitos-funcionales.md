# Requisitos funcionales

## RF-01 — Registrar sala o Ward

El sistema deberá permitir registrar una nueva sala o unidad hospitalaria indicando su nombre y asociándola al tenant correspondiente.

## RF-02 — Registrar cama

El sistema deberá permitir registrar una cama asociándola a un `Ward` existente mediante `ward_id`.

## RF-03 — Validar Ward

Antes de registrar una cama, el sistema deberá comprobar que el `Ward` seleccionado exista.

## RF-04 — Asignar estado operativo

El sistema deberá permitir asignar a una cama uno de los estados operativos existentes:

- `disponible`
- `ocupada`
- `limpieza`
- `mantenimiento`

## RF-05 — Cambiar estado operativo

El sistema deberá permitir actualizar el estado operativo de una cama registrada.

## RF-06 — Validar estado

El sistema deberá rechazar cualquier estado que no corresponda a los estados permitidos.