# Requisitos no funcionales

## RNF-01 — Integridad

El sistema deberá evitar que se registre una cama asociada a un `Ward` inexistente.

## RNF-02 — Seguridad

Las operaciones de creación y modificación deberán realizarse por usuarios autenticados y autorizados.

## RNF-03 — Aislamiento por tenant

Los wards y camas deberán pertenecer al tenant correspondiente y no deberán modificarse desde otro tenant.

## RNF-04 — Mantenibilidad

Las responsabilidades relacionadas con wards, camas y estados operativos deberán mantenerse separadas para facilitar cambios futuros.