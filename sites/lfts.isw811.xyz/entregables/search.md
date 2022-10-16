# Laravel from the scratch

En esta sección trabajaremos con la opción de buscar

--------------------------------------------------------

## **Primera parte**
### Buscar (El método desordenado):
--------------------------------------------------------

En este primer episodio de la sección 6 vamos a estar trabajando con el sistema de búsqueda pero de la manera desordenada.

Como primera instancia, estructuramos de una manera diferente la ruta que carga la página principal, como se muestra a continuación:

    Route::get('/', function () {
    $posts = Post::latest();

    if (request('search')) {
        $posts->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('body', 'like', '%' . request('search') . '%');
    }

    return view('posts', [
        'posts' => $posts->get(),
        'categories' => Category::all()
    ]);
    })->name('home');

de esta manera podremos encontrar lo que busquemos, sea que esté en el título o en el cuerpo del post y obvio si está en la base de datos.

--------------------------------------------------------

## **Segunda parte**
### Buscar (El método ordenado):
--------------------------------------------------------

En este episodio vamos a continuar con el método de buscar, pero esta vez vamos a ordenar el código.

Primeramente vamos a crear y trabajar con **controllers**.

Para crear un **controllers** utilizamos:

> ***php artisan make:controller "controller_name"***

Cambiamos la ruta, sustituimos la ruta utilizando o haciendo referencia al *controller*

> ***Route::get('/', [PostController::class, 'index'])->name('home');***

Creamos una funcion en el modelo *Post* llamado *scopeFilter* dentro de esta vamos a establecer las condiciones que teniamos anteriormente en las rutas para poder hacer el método de búsqueda.

Seguidamente, siguiendo con las rutas, cambiamos unpoco la que cargaba los post, de igual manera utilizando el controller procedimos a hacer lo siguiente:

> ***Route::get('posts/{post:slug}', [PostController::class, 'show']);***

de esta manera logramos cargar las posts del proyecto.

Por último en el *PostController* creamos 2 funciones:

**1- La función *index***: Esta función es la encargada de retornar la vista de la pantalla principal o el *home page*

**2- La función *show***: Esta función es la encargada de retornar la vista de la pantalla que carga los posts.
