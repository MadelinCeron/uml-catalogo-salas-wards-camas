# Semana 03 - Micro-HIS

## Catálogo de salas, wards y camas

### Descripción

Esta actividad implementa un Micro-HIS en PHP 8.2+ vanilla para el módulo
**Catálogo de salas, wards y camas**.

El flujo desarrollado permite crear una sala o Ward y registrar una cama
asociada con control de estado operativo.

## Arquitectura

La solución está organizada en cuatro capas:

- Presentation: recibe los datos del usuario y muestra los resultados.
- Application: coordina el caso de uso de creación de Ward y cama.
- Domain: contiene las entidades y reglas principales del módulo.
- Persistence: implementa el acceso a datos mediante PDO y sentencias preparadas.

## Flujo implementado

1. Ingresar los datos de la sala / Ward.
2. Validar el nombre del Ward.
3. Guardar el Ward.
4. Ingresar los datos de la cama.
5. Validar el código de cama.
6. Validar el estado operativo.
7. Asociar la cama con el Ward.
8. Guardar la cama.
9. Mostrar el resultado.

## Estados operativos

Los estados disponibles son:

- disponible
- ocupada
- limpieza
- mantenimiento

## Persistencia

Se utiliza PDO con SQLite como base de prueba.

Las consultas utilizan sentencias preparadas para evitar construir SQL
directamente con datos ingresados por el usuario.

La base de datos local `micro_his.sqlite` no se incluye en Git.

## Pruebas

La actividad incluye pruebas automatizadas en PHP vanilla para:

- Camino feliz de creación de Ward y cama.
- Validación de Ward sin nombre.
- Error simulado de persistencia.
- Código de cama duplicado.
- Estado operativo inválido.

Ejecutar:

```bash
php tests/run.php