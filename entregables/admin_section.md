# Laravel from the scratch

En esta sección vamos a trabajar con la seccion de administrador.

--------------------------------------------------------

## **Primera parte**
### Limitar el acceso solo para administrador:
--------------------------------------------------------

Vamos a implementar una ruta que va basada en el PostContoller 
y crearemos un metodo create.

Vamos a post-contoller y creamos el metodo, dentro de este vamos a retornar una vista  posts.create y creamos esta vista en los posts de las views, reutilzaremos el layout que hicimos en capitulos pasados.

En nuestro post-contoller vamos a realizar una validacion de que si somos 'guest' o 'invitados' vamos a hacer un abort 403 o utilizaremos el response class con un error de forbidden.

Crearemos un middleware llamado admins only luego copiamos la logica de nuestro post-contoller y la pegamos en nuestro middleware. 

Vamos a nuestro kernel y vamos a agregar la siguiente linea:

>***'admin' => MustBeAdmin::class,***

nos dirigimos a las rutas y agregamos el middleware a nuestra ruta recien creada

--------------------------------------------------------

## **Segunda parte**
### Crear el formulario para hacer una publicacion:
--------------------------------------------------------

Una vez tieniendo la validacion del administrador, podemos crear el formulario que permita establecer las publicaciones de la pagina.

Creamos los campos que necesitamos para realizar la publicacion, titulos, excerpts, etc...

Creamos la respectiva ruta para el post de los campos de texto del form  para almacenar esos datos.

Seguidamente se hacen las validaciones de los campos de texto para crear un nuevo post.