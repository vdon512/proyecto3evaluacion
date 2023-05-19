Partes lógicas.
APP/
controllers - recibe la petición y decide qué hacer y llama funciones de models
models - trabaja con la información que le envia controllers (po ej. BD)
views - presentacion de la información.

PUBLIC/
CONTROLLER
todos los url van a esa carpeta

Base de datos.
config/config_db.php  - La conexión a la base de datos
core/db.php(base) - esta clase garantiza que podemos crear solo un objeto de una clase (si el objeto no está creado se crea uno y si está creado lo devuelve). 
                    aquí hacemos la conexion, ejecutamos la consulta, comprobamos si la consulta ha tenido éxito 
models/Model.php(base) - clase abstracta
 
En Controller creamos la clase y pasamos los datos a la vista
vistas tienen el mismo nombre que actions
Para pasar variables a la vista lo hacenos con el método de Controller
# Projecto 3a evaluación
***
## Índice:
1. [Información general](#general-info)
2. [Tecnologías](#technologies)
3. [Installation](#installation)
4. [Collaboration](#collaboration)
5. [FAQs](#faqs)
   Para realizar este proyecto he utilizado lenguajes PHP y JS.
   Instalatión
