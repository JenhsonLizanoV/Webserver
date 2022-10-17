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

--------------------------------------------------------

## **Segunda parte**
### Hashing automático de contraseñas con mutadores:
--------------------------------------------------------

En el capítulo anterior, realizamos un registro de usuarios, pero notamos que la contraseña no se guarda de manera correcta, en este episodio vamos a solucionarlo.

Nos dirigimos al modelo del usuario y creamos una función que reciba por parámetro la contraseña para seguidamente encriptarla.

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

de esta manera ya podemos implementar la contraseña encriptada a la base de datos.

--------------------------------------------------------

## **Tercera parte**
### Validación fallida y datos de entrada antiguos:
--------------------------------------------------------

En este capítulo vamos a solucionar algunos errores de validación.

Vamos a implementar mensajes cuando haya un error en las validaciones de los input, es decir, si incumplimos el mínimo o máximo de la extensión establecida, que nos muestre un mensaje de error de validación.

Luego, que pasa si tenemos un registro en base de datos y duplicamos esa información, pues nos dará un error de **SQL**, para solucionarlo vamos a establecer los atributos como *unique* y vamos a darle algunos argumentos como por ejemplo la tabla y la columna, ejemplo:

    $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255',
        ]);

de igual manera va a pasar si no validamos el email, ya que en la base de datos este es un email único, por ende, también debemos validar la situación en caso de que este se repita, entonces el código quedatía tal que así:

    $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|max:255',
        ]);

--------------------------------------------------------

## **Cuarta parte**
### Mostrar un mensaje flash de éxito:
--------------------------------------------------------

En este episodio vamos a mostrar un mensaje flash de éxito cuando logramos registrarnos.

Nos dirigimos al controlador del registro e implementamos lo siguiente:

>***session()->flash('success', 'Your account has been created.')***

luego nos dirigimos a nuestro *layout.blade.php* y al final creamos una condición de que si la *session()* contiene la key word *'success'*, entonces que muestre en mensaje 'Your account has been created', ejemplo:

    @if (session()->has('session'))
    <div class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
        <p>{{ session('success') }}</p>
    </div>

y así tendremos un mensaje flash desplegado en nuestra pantalla con el mansaje 'Your account has been created'.

Vamos a modificar un poco el código, vamos a establecerle un timer al mensaje que se muestra en la pantalla simplemente hacemos lo siguiente:

        @if (session()->has('session'))
            <div x-data="{ show: true }">
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
                <p>{{ session('success') }}</p>
            </div>

Todo esto lo vamos a establecer en un componente aparte, para no tener tanta información dentro del layout y también para mantener las buenas prácticas.