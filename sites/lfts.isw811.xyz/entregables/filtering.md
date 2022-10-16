# Laravel from the scratch

En esta sección trabajaremos el apartado de filtros

--------------------------------------------------------

## **Primera parte**
### Restricciones avanzadas de consultas elocuentes:
--------------------------------------------------------

Para comenzar con este episodio, vamos a cargar todos los posts que estan asociados a una categoría.

En primer lugar vamos a la función *index* creada en el controlador de los posts y lo cambiamos tal que así:

    public function index()
    {
        return view('posts', [
            'posts' => Post::latest()->filter(request(['search', 'category']))->get(),
            'categories' => Category::all()
        ]);
    }

Luego vamos al método *scopeFilter* y realizamos una de 2 opciones:

1- Cambiamos el método

2- Duplicamos el método

en este caso utilizaremos la opción 2 y le haremos algunos cambios al código que acabamos de duplicar.

Entonces, una vez duplicado el código lo vamos a modificar, de manera que al realizar el *query* este sea interpretado de manera correcta por la app:

>***$query->when($filters['category'] ?? false, fn ($query, $category) =>
        $query->wherehas('category', fn($query ) => $query->where('slug', $category)));***

En el *PostController* agregramos el *currentCategory* para que basado en la programación que hicimos en anteriores videos, este cargue la categoría actual en el dropdown, y la ruta que teniamos anteriormente la vamos a eliminar porque ya no será necesaria.

--------------------------------------------------------

## **Segunda parte**
### Extreyendo una categoria del la pagina con el componente dropdown:
--------------------------------------------------------

Vamos a cambiar un poco el *_posts-header.blade.php*.

En el blade mencionado, vamos a cortar el dropdown que tenemos ahí y vamos a crear un algoritmo nuevo.
Creamos un nuevo componente llamado *CategoryDropdown* que va a tener el archivo dropdown que cortamos en el *_posts-header.blade.php*.
El archivo creado retorna una vista, a esa vista le añadimos todas las categorias que traermos de la base de datos. Como realizamos este cambio, ya no necesitamos más pasarle las categorias por rutas a los objetos del proyecto, por ende esas referencias las podemos eliminar de las rutas y del controlador.
Al realizar estos cambios, de nuevo tendremos el problema de que no se va a mostrar la categoria en la que estamos sistuados en la página, para resolverlo solamente movemos:

>***'currentCategory' => Category::firstWhere('slug', request('category'))***

al componente del dropdown que creamos al inicio y listo.