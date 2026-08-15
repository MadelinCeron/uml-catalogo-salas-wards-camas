# Criterios de aceptación

## CA-01 — Registro correcto de Ward

**Dado** que el administrador se encuentra autenticado y existe un tenant válido,  
**cuando** registra un Ward con la información requerida,  
**entonces** el sistema debe registrar la sala o unidad hospitalaria dentro del tenant correspondiente.

## CA-02 — Registro correcto de cama

**Dado** que existe un Ward válido,  
**cuando** el administrador registra una cama con un código y un estado permitido,  
**entonces** la cama debe quedar asociada al Ward indicado.

## CA-03 — Ward inexistente

**Dado** que se intenta registrar una cama,  
**cuando** el `ward_id` indicado no corresponde a un Ward existente,  
**entonces** el sistema debe rechazar el registro de la cama.

## CA-04 — Estado operativo válido

**Dado** que se registra o modifica una cama,  
**cuando** se utiliza uno de los estados `disponible`, `ocupada`, `limpieza` o `mantenimiento`,  
**entonces** el sistema debe aceptar el estado.

## CA-05 — Estado operativo inválido

**Dado** que se intenta registrar o modificar una cama,  
**cuando** se proporciona un estado diferente a los permitidos,  
**entonces** el sistema debe rechazar la operación e informar que el estado no es válido.