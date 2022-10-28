# Laravel from the scratch

En esta sección vamos a trabajar con APIs.

--------------------------------------------------------

## **Primera parte**
### Ajustes de la API de Mailchimp:
--------------------------------------------------------

A continuación vamos a utilizar la API de Mailchimp.

Vamos a ir a la [página de mailchimp](https://mailchimp.com/guesswork/?gclid=Cj0KCQjw--2aBhD5ARIsALiRlwC9W0yXfCI5Y1eKPWa3CgIEVa9yszrzkLDGjUfbTSU4Ka247EZhKSMaAoDXEALw_wcB&gclsrc=aw.ds) y creamos una cuenta, vamos al apartado de nuestro perfil y le damos en *account*, luego vamos a extras y a API Keys y damos click en *Create A Key* y copiamos nuestro API Key que no s brinda la página.

Una vez que tenemos nuestra API key copiada, vamos a dirigirnos al arcivho *.env* de nuestro proyecto y colocamos lo siguiente:

>***MAILCHIMP_KEY = "API Key"***

luego en la carpeta config de nuestro proyecto nos vamos a services y ahi colocamos >

        'mailchimp' => [
            'key' => env('MAILCHIMP_KEY')
        ]

para poder utiizar nuestra API Key.

Luego vamos a ir a otra [mailchimp marketing](https://mailchimp.com/developer/marketing/guides/quick-start/) y vamos a instalar la libreria para nuestro lenguaje de programacion, en este caso *PHP*.

>***composer require mailchimp/marketing***

Luego de instalar la libreria, vamos a las rutas de nuestro proyecto y hacemos un llamado del metodo mailchimp con lo que nos dan en la pagina:

    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
	    'apiKey' => 'YOUR_API_KEY',
	    'server' => 'YOUR_SERVER_PREFIX'
    ]);

    $response = $mailchimp->ping->get();
    print_r($response);

cambiamos *'YOUR_API_KEY'* por nuestra API key y en *'YOUR_SERVER_PREFIX'* colocamos *us6*.

Una vez realizado los pasos anteriores, vamos al apartado *Get List Info* y copiamos la parte del response para reemplazarla por la que ya tenemos en nuestras rutas.

    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
	    'apiKey' => 'YOUR_API_KEY',
	    'server' => 'YOUR_SERVER_PREFIX'
    ]);

    $response = $mailchimp->lists->getAllLists();
    print_r($response);

De esta manera podemos ir obteniendo la API para nuestro proyecto, tambien podemos agragar miembros nosotros mismos con el comando addMembers.

luego de que agregamos un nuevo miembro, nos dirigimos a la [pagina de mailchimp](https://mailchimp.com/guesswork/?gclid=Cj0KCQjw--2aBhD5ARIsALiRlwC9W0yXfCI5Y1eKPWa3CgIEVa9yszrzkLDGjUfbTSU4Ka247EZhKSMaAoDXEALw_wcB&gclsrc=aw.ds) y nos dirigimos a *contacts* y tendremos el que hemos agregado.

--------------------------------------------------------

## **Segunda parte**
### Hacer que el formulario de boletín funcione:
--------------------------------------------------------

Vamos a hacer algunos cambios en la ruta que establecimos en el capitulo anterior, vamos a establecerla de tal manera que podamos hacer post de los formularios, es decir, vamos a establecer el *Route* de tipo *post* y vamos a hacer un *request* de los campos que necesitamos, en este caso vamos a utilizar el *email address*, recordemos que siempre hay que hacerle un *required* y validar que sea de tipo *email* y listo, ya podemos suscribirnos con nuestro correo. 

Al validar que el correo sea 'real' vamos a obtener un problema y el software se va a caer, para arreglar esto, podemos implementar un try-catch dentro de nuestra ruta para que no suceda esto.

--------------------------------------------------------

## **Tercera parte**
### Extraer un servicio de boletín:
--------------------------------------------------------

Para este episodio, vamos a dirigirnos app->services y ahi creamos un archivo .php para implementar el metodo que cumple con la creacion del newsletter, creamos una funcion y enviamos por parametros una variable tipo string.

Tomamos nuestro codigo de mailchimp y lo insertamos en la funcion que acabamos de crear anteriormente, luego la importamos y la ingresamos dentro de nuestro try en el archivo de rutas.

Dentro de la funcion de la ruta vamos a declarar una variable de tipo Newsletters y le seteamos el metodo suscribe y le enviamos por parametro un request del email que tenemos en el form.

En cofig->services en 'mailchimp' vamos implementar una lista donde vamos a tener los suscribers de la app y en .env vamos a setear la lista de suscribers con el id de un suscriber.

Luego dentro de la funcion de suscribe obtenemos los datos que hay en el config y los seteamos en una lista.

Seguidamente creamos una funcion cliente el cual va a retornar nuestra clave api y el servidor que usamos.

Con todo lo que hemos arreglado hasta ahora podremos acortar nuestra ruta y normalizarla a como tenemos las demas rutas, solo que esta va a extender de nuestra controlador newsletter, el cual vamos a proceder a crear con una funcion para invocar nuestra funcion y ahi sea donde se realice la validacion con el try-catch.

--------------------------------------------------------

## **Cuarta parte**
### Cofres de juguetes y contratos:
--------------------------------------------------------

Ok, vamos a implementar un costructor en el newsletter.php y por parametro pasamos el una variable de tipo ApiClient.

En el AppServicesProvider en la funcion register, colocamos lo siguiente:

      app()->bind(Newsletter::class, function(){
        return new Newsletter(
            new ApiClient(),
            'foobar'
        );
      });
 
 todo con el fin de simular una caja de juguetes, si lo quiero utilizar abro la caja e invoco el juguete que quiero, de lo contrario guardo el juguete y cierro la caja, entonces dentro de nuestro codigo anterior, colocamos el algoritmo  que me controla el ApiClient y vamos a retornar ese cliente y claramente vamos a eliminar el codigo que teniamos en nuestra clase newsletter, el que estaba controlando al cliente.

 Vamos a renombrar nuestra clase newsletter y vamos a crear otra clase llamada ConvertKitNewsletter y vamos a crear una interfaz llamada newsletter la cual va a recibir por parametros del email  y una lista luego en la clase que renombramos, va a implementar esta interfaz al igual que el convertKitNewsletter.

En el proveedor de servicios de nuestra app, vamos a extender de la interfaz Newsletter y listo, todo funciona perfecto.