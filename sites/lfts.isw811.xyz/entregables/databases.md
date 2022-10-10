# Laravel from the scratch

En esta sección trabajaremos con bases de datos.

--------------------------------------------------------

## **Primera parte**
### Archivos de entorno y conexiones de base de datos:
--------------------------------------------------------
En este apartado, estariamos editando el archivo .env de nuestro proyecto de laravel, pero antes de esto, tenemos que hacer algunas instalaciones previas.
Dicho proceso de instalaciones se pueden ver en:
>**[Procesos previos a la cofiguracion del .env](https://gitlab.com/mizaq/lampondebian/-/blob/master/docs/db-installation.md)**

Luego de realizar estos procesos, ya estamos listos para continuar con el siguiente episodio.

## **Segunda parte**
### Migraciones: las bases absolutas:
--------------------------------------------------------
Este episodio lo comenzamos viendo primeramente la estructura de nuestra tabla user con el siguiente comando:

>*mysql -u user_laravel -p*

>introducimos la contraseña y le damos a **Enter**

>Luego usamos: *use "database_name"*

>Hacemos un *show tables*

>y por último un *describe "table_name"*

y así podremos observar la estructura de nuestra tabla

![text image](../img/imagen42.png)

Como parte de este segundo episodio, se explica los diferentes codigos que se pueden usar para las migraciones, tales como un **rollback** que funciona para retroceder migraciones recien realizadas, un **migrate:fresh** que funciona para dropear todas las tablas que comprenden las bases de datos, con este comando se debe tener cuidado porque en un ambiente de desarrollo de produccion podria provocar graves problemas.

A continuación se muestra una imagen de lo que podria pasar si utilizamos **migrate:fresh** en un ambiente de produccion:

![text image](../img/imagen43.png)

## **Tercera parte**
### Elocuencia y el patrón de registro activo:
--------------------------------------------------------

Para iniciar este episodio, necesitamos ingresar lineas de datos a la tabla que ya tenemos creada llamada *user*

1- Para insertar un nuevo usuario debemos ingrasar a la consola
>**php artisan tinker**

2- Creamos un nuevo usuario accediendo a la ruta donde está la clase *User*
>**$user = new App\Models\User;**

3- Ingresamos datos quemados al usuario, como mínimos vamos a utilizar el nombre, el email y una contraseña:
>**$user->name='Your_name';**

>**$user->email='Your_email';**

>**$user->password=bcrypt('Your_password');**

La palabra *bcrypt* funciona para guardar una contraseña de manera encriptada.

por último, para guardar la inserción de los datos, realizamos el siguiente comando:
>**$user->save();**

Acá podemos observar los datos que recién guardamos:
![text image](../img/imagen44.png)

