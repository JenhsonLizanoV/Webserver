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

--------------------------------------------------------

## **Tercera parte**
### Validar y almacenar miniaturas de publicaciones:
--------------------------------------------------------

Vamos a agregar un campo nuevo al formulario el cual va a almacenar la imagen de la miniatura de los post nuevos que hagamos.

Realizamos un ***php artisan storage:link*** para crear nuestro directorio dentro de la carpeta public donde se van a guardar las miniaturas.

Nos dirigimos a la migración de los posts y vamos a agregar el campo para las miniaturas.

Hacemos un refresh de las migraciones ***php artisan migrate:fresh --seed*** y claramente debemos agregar el campo a las validaciones de nuestro controlador.

Se aplican los cambios con un asset a todos las partes del proyecto que implican miniaturas y listo, ya tenemos miniatutas dinamicas.

--------------------------------------------------------

## **Cuarta parte**
### Extraer componentes de hoja de forma específica:
--------------------------------------------------------

En este capitulo solamente vamos a implementar los campos de manera generica por decirlo de alguna manera, es decir, vamos a crear un blade por cada campo que necesitemos replicar en nuestra app, siendo asi el ejemplo de los inputs, vamos a establecer un blade para los inputs para limpiar aun mas nuestro codigo y se vea mas ordenado y eficiente, tambien se crea otro blade para los text area, etc...

Vamos a crear un blade por cada cosa que necesitemos duplicar en nuestro codigo.

Todo esto lo vamos a almacenar en un carpeta form dentro de components.

--------------------------------------------------------

## **Quinta parte**
### Ampliar el diseño de administración:
--------------------------------------------------------

En este capitulo, vamos a mejorar el diseño de admin, para eso vamos a donde mostramos el nombre de la persona logueada en ese momento y le hacemos un dropdown para que este despliegue el menu del admin con las acciones que puede realizar este, en este caso seria crear un nuevo post y le damos algunos estilos esteticos al dropdown, tambien vamos a agregar una opcion dashboard que nos va a permitir volver a nuestra pagina de post.

Tambien vamos a ingresar una opcion la cual permita salir de la pagina, es decir, un log out, para el log out tenemos que darle un formato ditinto y vamos a hacer una opcion de prevent la cual nos permita elegir si estamos seguros de que queremos cerrar sesion.

Creamos un componente que almacene todas las configuraciones de publicar un nuevo post, es decir, un blade que almacene todo lo que ya teniamos para hacer un nuevo post para simplemente evitar tener que repetir siempre el mismo codigo.

Con los blades de form, vamos a mejorar tambien la pantalla de registro y de login, simplemente vamos a utilizar el formato de del componente forms en estas pantallas para optimizar aun mas nuestro cogido.

--------------------------------------------------------

## **Sexta parte**
### Crear formulario de editar y eliminar un Post:
--------------------------------------------------------

Vamos a crear un controlador para que los administradores puedan hacer y deshacer con los post, vamos a implementar una ruta que va a ser controlada por un AdminPostController, este controlador va a ser el encargado de eliminar o editar los atributos o mas bien la info que tienen los atributos de los posts, dichos sean titulos, cuerpos, categorias, etc...

Creamos el controlador como lo hemos hecho anteriormente utilizando artisan.

Ahora todos los posts los vamos a visualizar con la opcion de editar o eliminar, vamos a ver sus estados "si están publicados".

Implementamos la ruta para la cual vamos a necesitar el controlador que acabamos de crear con el metodo edit, de esta manera procederemos a crear el form que cargue los datos editables del post dentro de los campos del formulario y seguidamente procederemos a crear la logica que nos permita cambiar lo que deseemos.

Claramente tambien deberemos implementar la logica para el metodo de eliminar un post, al ser un delete, este solo necesita obtener el id del post al cual está haciendo focus el puntero y proceder a obtenerlo para eliminarlo.

--------------------------------------------------------

## **Sétima parte**
### Lógica de validación de grupos y tiendas:
--------------------------------------------------------

En este capitulo simplemente se harán validaciones de la logica de algunos puntos específicos, tal sea el caso de los posts, para editar y almacenar se necesita lo mismo, lo unico que cambia es el slug del update ignora el id del post, entonces debemos irnos e implementar una variable a la cual se le va a asignar un nuevo post en el metodo store y en la imagen validamos si el post ya existe, si exite entonces que cargue la imagen, sino que el campo de la miniatura sea requerido.

Al tener el update y el store identicos, podemos hacer un solo metodo el cual valide si el post va a ser almacenado o va a ser editado para eso creamos un array dentro del metodo que valida los campos y establecemos que si es un nuevo post que lo guarde o le haga un *store* sino que actualice los datos en la base de datos.