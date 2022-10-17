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

--------------------------------------------------------

## **Tercera parte**
### Filtro por autor:
--------------------------------------------------------

Vamos a realizar un filtro por autores.

Nos dirigimos al archivo *post-card.blade.php* y donde tenemos el nombre del autor prodecedemos a establecerlo como un elemento clickeable.
En la ruta agregamos un *.index* para que el render nos reconozca la página, ya que en el capitulo anterior para limpiar un poco el código metimos las vistas principales en una carpeta y les cambiamos el nombre.
Consiguientemente vamos al modelo *Post* y hacemos lo siguiente:

> ![text image](../img/imagen69.png)

luego nos dirigimos al controlador de los posts, en el request agregamos *author*, probamos y:

> ![text image](../img/imagen70.png)

> **Importante:** Podemos combinar los métodos de filtrado, es decir, podemos clickear en un autor, luego dentro de eso podemos realizar búsqueda de palabras, etc...

Como ya sabemos, al agregar: ***"/?author={{ $post->author->username }}"*** a la ruta de cada pantalla podremos eliminar la ruta que utilizabamos para eso.

--------------------------------------------------------

## **Cuarta parte**
### Combinar categorías y consultas de búsqueda:
--------------------------------------------------------

En el *action* del *_header.blade.php* vamos a obtener tambien lo que pongamos en el text field de buscar para poder hacer un match entre la categoría y la búsqueda.
> ***action="/?{{ request()->getQueryString() }}"***
Una vez hecho esto, no vamos a tener ningún resultado, porque tiene que ser aplicado en cada form.

Otra opción es crear un *input* de tipo *hidden* para que se almacene el resultado de la búsqueda que vamos a realizar junto al filtro de la categoría.

Luego de realizar de manera correcta el seleccionar una categoría y buscar una palabra sin que la categoria se resetee, vamos hacer el mismo procedimiento pero esta vez vamos a hacerlo que cuando busquemos una palabra podamos seleccionar una categoría sin perder la palabra que estabamos buscando.

Nos dirigimos al *category-dropdown.blade.php* y buscamos nuestro item de dropdown, una vez estando ahí, nos dirigimos a la ruta que está en *x-dropdown-item* y a la ruta del *href* le asignamos lo siguiente:

>***"/?category={{ $category->slug }}&{{ http_build_query(request()->except('category')) }}"***

de esta manera nos aseguramos de poder buscar una palabra y consiguientemente buscar una categoría sin perder la palabra que estabamos buscando.

Si todo va bien se debería de mostrar algo así:

>![text image](../img/imagen71.png)
