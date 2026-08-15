# Guía breve para defensa oral

## 1. ¿Qué módulo trabajó?

Trabajé el módulo ASII-06, Catálogo de salas, wards y camas.

## 2. ¿Qué flujo analizó?

La creación de una sala o Ward, el registro de una cama asociada y el control de su estado operativo.

## 3. ¿Qué principio SOLID aplicó?

Apliqué SRP, Principio de Responsabilidad Única.

## 4. ¿Qué significa SRP?

Significa que cada clase debe tener una responsabilidad concreta y una sola razón principal para cambiar.

## 5. ¿Cuál era el problema del diseño anterior?

Un único componente podía encargarse de wards, camas y estados operativos, concentrando varias responsabilidades.

## 6. ¿Cómo se aplicó SRP?

Se separó el diseño en:

- WardController para wards.
- BedController para camas.
- BedStatusService para estados operativos.

## 7. ¿Por qué Bed depende de Ward?

Porque cada cama debe estar asociada a un Ward existente mediante `ward_id`.

## 8. ¿Cuáles son los estados actuales de las camas?

- disponible
- ocupada
- limpieza
- mantenimiento

## 9. ¿Se modificó la base de datos?

No. La actividad utiliza la estructura actual `Ward → Bed`.

## 10. ¿Qué beneficio aporta SRP?

Facilita el mantenimiento porque los cambios en wards, camas o estados pueden realizarse en componentes separados.

## 11. ¿Qué pasaría si cambia la estructura de la base?

El diseño deberá actualizarse, pero la separación de responsabilidades puede mantenerse.

## 12. ¿Qué validación importante debe realizarse al crear una cama?

Debe verificarse que el Ward exista y que el estado operativo sea válido.