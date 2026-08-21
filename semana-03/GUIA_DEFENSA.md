# Guía breve para defensa oral

1. **¿Qué desarrollé?**  
   Un Micro-HIS para crear una sala o Ward y registrar una cama con control de estado operativo.

2. **¿Qué tecnología utilicé?**  
   PHP 8.2+ vanilla, sin framework, utilizando PDO para la persistencia.

3. **¿Qué arquitectura utilicé?**  
   Separé el proyecto en Presentation, Application, Domain y Persistence.

4. **¿Qué hace Domain?**  
   Contiene las entidades Ward y Bed, los estados operativos y las reglas principales del negocio.

5. **¿Qué hace Application?**  
   Coordina el caso de uso para crear el Ward, validar los datos y registrar la cama.

6. **¿Qué hace Presentation?**  
   Recibe los datos desde el formulario y muestra al usuario el resultado o los errores.

7. **¿Qué hace Persistence?**  
   Guarda y consulta los datos mediante PDO y sentencias preparadas.

8. **¿Qué estados puede tener una cama?**  
   disponible, ocupada, limpieza y mantenimiento.

9. **¿Qué pruebas realicé?**  
   Camino feliz, Ward sin nombre, error de persistencia, código de cama duplicado y estado operativo inválido.

10. **¿Por qué usé sentencias preparadas?**  
    Para enviar los datos mediante parámetros y evitar construir consultas SQL directamente con la información ingresada por el usuario.