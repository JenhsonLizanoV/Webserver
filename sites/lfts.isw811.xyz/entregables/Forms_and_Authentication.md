# Laravel from the scratch

En esta sección vamos a trabajar con formularios y autenticaciones.

--------------------------------------------------------

## **Primera parte**
### Construyendo una página de registro de usuario:
--------------------------------------------------------

Para empezar con el primer episodio del módulo 9, vamos a crear una ruta para poder acceder a una página de registro.
Como hemo hecho en anteriores videos, vamos a crear la ruta siguiendo los ejemplos que vimos cuando implementamos los *controllers*
En rutas establecemos lo siguiente:

>***Route::get('register', [RegisterController::class, 'create']);***

luego de establecer la ruta, vamos a crear el controlador *RegisterController*.

Si lo vamos a implementar por línea de comandos lo hacemos de esta manera:

>***php artisan make:controller RegisterController***

Una vez implementado el controlador, vamos a crear una función llamada *"create"* y solo vamos a retornar un "Hello World", solo para estar seguros de que funciona.

Estando seguros de que funciona, vamos a retornar una vista llamada *register.create*.
Hecho esto, nos vamos a la carpeta *views* y creamos otra carpeta llamada *register* y dentro de esta creamos un archivo llamado *create*, copiamos y pegamos el *x-layout* y la etiqueta *section* para obtener el mismo formato con el que venimos tabajando.

Creamos un *main*, agregamos un *form* con método *post* y una acción que no va a dirigir a */register*, dentro de este *form* vamos a crear todas las credenciales necesarias para un registro.

Una vez creados los campos para colocar las credenciales del usuario, cuando damos en el boton de registrar, vamos a obtener un error el cual nos dice que no podemos hacer un *post* en una ruta *get* para solucionar este problema simplemente duplicamos la ruta que creamos al inicio y en cambiamos el *get* por un *post* y en el comment convention cambiamos el nombre a, por ejemplo, *store*, ejemplo:

>***Route::post('register', [RegisterController::class, 'store']);***

luego vamos al controlador y creamos la función *store* que nos va a almacenar las credenciales que ingresamos en los *input*

Acá podemos observar algunas reglas de validaciones de Laravel para aplicarlas a nuestro controlador:

>***[Validaciones de Laravel]('https://laravel.com/docs/9.x/validation#available-validation-rules')***

Al completar lo anterior, si vamos y hacemos un submit de los datos vamos a tener un error "419", para resolverlo solo debemos ir a nuestra página de registro y dentro del *form* colocamos un *"@csrf"* que nos genera un *input* de tipo *hidden* y este tendrá un valor, este será el valor identificador de cada página, esto con el fin de evitar los peligros a los que nos exponemos como un *spear phishing*, etc...

>***[Que es @csrf]('https://www.ionos.es/digitalguide/servidores/seguridad/cross-site-request-forgery/')***

Una vez que sabemos que los datos son válidos, implementamos el método de crear usuarios dentro de la función *store* del controlador:

    public function store(){
        User::create(request()->validate([
            'name' => 'required|max: 255',
            'username' => 'required|max: 255|min: 3',
            'email' => 'required|email|max: 255',
            'password' => 'required|min: 8|max: 255'
        ]));
        return redirect("/");
    }

Debemos recordar que antes de registrar un usuario, debemos ir al modelo de *User* en en los *fillable* debemos implementar los valores que nos hacen falta, en un inicio solo teniamos el nombre, email y contraseña, ahora debemos añadir los atributos que estamos enviando en el request, en este caso ***username***
o bien para omitir este proceso de agregar info a los *fillable* podemos simplemente cambiar el *fillable* por un *guarded*, en caso de que necesitemos más datos.