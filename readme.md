# Api movies
Este es el respositorio de un api, Creado con el framework `Laravel` para el lenguaje de programación `Php`.

## ¿Cómo implementar el proyecto en su entorno?
* Primero es necesario contar con un gestor de bases de datos como `Mysql`,`Postgresql`,`SQL server` entre otros.
* Tener instalado `composer`.
* Descargar el proyecto.
*  Luego se procede a agregar las credenciales al archivo de configuración `.env`. En el repositorio de este proyecto se incluye un archivo de ejemplo llamado `.env.example`, ese archivo debe ser renombrado a `.env` y paso seguido, agregar las credenciales de su base de datos.
*  Correr las `migraciones` y los `seeds` , con los comandos
	````
		$php artisan migrate
		$php artisan db:seed
	````
*  Para ver los Endpoints funcionando se pueden realizar de dos formas `swagger` y`Postman`.

#### Swagger
*Dentro de la carpeta anteriormente descargada, una carpeta que se llama `swagger` se debe mover algun servidor local como `Apache` para que puede ser ejecutado.

#### Postman
*Solo se deben ejecutar las url de los endpoints.

## Funcionalidad
### Endpoints
* /api/auth/login => autentica el usuario utilizando JWT
* /api/auth/register => crea un usuario nuevo en el sistema
* /api/auth/logout => invalida el token del usuario
* /api/movies => retorna una lista de películas en la base de datos
* /api/movies/{id} => retorna el id de la película especificada o 404 si el id de la película no existe.

Para poder acceder al endpoint de películas y cerrar sessión es necesario enviar un token previamente obtenido mediante el `login`, si se usa `postman` solo se agrega en el header


		Authorization: Bearer {yourtokenhere}
