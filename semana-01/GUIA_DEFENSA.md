## Guía breve para defensa oral

1. **¿Qué proceso modelé?**  
   La creación de una sala o `Ward` y posteriormente una cama con control de estado operativo.

2. **¿Qué estructura de base de datos utilicé?**  
   Se utilizó la base antigua, donde `Ward` representa una sala o unidad hospitalaria y `Bed` se relaciona mediante `ward_id`.

3. **¿Qué representan los tres diagramas?**  
   El caso de uso muestra las acciones del administrador; el de actividad muestra decisiones y excepciones; y el de secuencia muestra los mensajes entre interfaz, servicio y base de datos.

4. **¿Qué estados puede tener una cama?**  
   `disponible`, `ocupada`, `limpieza` y `mantenimiento`.

5. **¿Qué mejora queda pendiente?**  
   Revisar si posteriormente será necesario separar los conceptos de Ward, sala y cama mediante una estructura como `Ward → Sala → Cama`.