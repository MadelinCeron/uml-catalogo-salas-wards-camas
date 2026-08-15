# Aplicación del principio SRP

## Principio seleccionado

Para esta actividad se aplica el principio **Single Responsibility Principle (SRP)** o Principio de Responsabilidad Única.

Según la fuente obligatoria de la actividad, cada clase debe poseer una responsabilidad única y concreta, evitando que una misma clase tenga diferentes razones para cambiar.

## Aplicación al módulo ASII-06

El flujo analizado corresponde a:

- creación de una sala o Ward;
- registro de una cama;
- asociación de la cama con un Ward;
- asignación y control de su estado operativo.

En un diseño donde toda esta lógica se concentra en una sola clase, esa clase tendría diferentes responsabilidades y distintas razones para cambiar.

Por esta razón se propone separar las responsabilidades.

## Diseño antes de aplicar SRP

Antes de aplicar SRP se puede representar un único componente encargado de todo el flujo:

```text
CatalogoController
│
├── Registrar Ward
├── Validar Ward
├── Registrar cama
├── Validar cama
├── Validar estado
└── Cambiar estado operativo