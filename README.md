Español: https://github.com/KumbiaPHP/Documentation/tree/master/es

English: https://github.com/KumbiaPHP/Documentation/tree/master/en

## API Rest para la gestión de usuarios mediante un login con JWT

REST-API

Login del usuario - Método **POST**:
http://localhost/backendcts2/api/login

Ingresar con los siguientes datos en formato JSON:
```json
{
	"correo" : "admin@admin.com",
	"clave" : "admin"
}
```
Esto devuelve un token que deberás enviar en las cabeceras para que el servicio REST
pueda saber que esta logueado y puedas tener acceso a las llamadas.

Realizar pruebas en PostMan, recuerda tener generado el token para poder enviarlo en
las cabeceras "Authorization": Bearer TuToken.

Obtener todos los usuarios - Método **GET**:
http://localhost/backendcts2/api/usuario

Obtener un usuario - Método **GET**:
http://localhost/backendcts2/api/usuario/$id

Crear un usuario - Método **POST**:
http://localhost/backendcts2/api/usuario

Información a enviar en formato JSON:
```json
{
	"nombre" : "Paul Arteaga",
	"correo" : "paul@correo.com",
	"clave" : "123456",
	"rol_id" : 2
}
```
Actualizar un usuario - Método **PUT**:
http://localhost/backendcts2/api/usuario/$id

Información a enviar en formato JSON:
```json
{
	"id": 2,
	"nombre": "Mace Windu",
	"correo": "mace@force.com",
	"rol_id": 2
}
```
Eliminar un usuario - Método **DELETE**:
http://localhost/backendcts2/api/usuario/$id