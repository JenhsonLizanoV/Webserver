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

