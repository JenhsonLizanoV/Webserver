# Laravel from the scratch

En esta sección vamos a trabajar con paginación

--------------------------------------------------------

## **Primera parte**
### Paginación ridículamente simple:
--------------------------------------------------------

Para ralizar el proceso de paginación es algo tan sencillo que es absurdo, primero nos vamos al controlador de los posts y en la funcion *index* cambiamos el *get()* final por un *paginate()* y si queremos podemos asignarle un número específico de posts que quiera ver, por ejemplo, *paginate(3)*, esto me mostrará solo 3 posts por páginas.

#### **Linkeando las páginas**

Nos dirigimos a la pagina *index.blade.php*, debajo de los posts vamos a simplemente llamar el método *links()* que tiene por defecto el método *paginate()* y listo.

Una vez lograda la paginación de los posts, vamos a tener un pequeño bug el cual al seleccionar una categoría, el sistema solo va a buscar esa categoría en la página actual, para solucionar esto, simplemente iremos a *category-dropdown.blade.php* y en el exclude añadimos la paginación, tal que así:

>***href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category, page')) }}"***

Luego agregamos esto: 
>***href="/?{{ http_build_query(request()->except('category, page')) }}"***

al *x-dropdown-item* para que al momento de seleccionar una categoría y buscar una palabra, cuando volvamos a seleccionar *"All"*, este no pierda el resultado de la búsqueda por palabra y excluya la categoría y la página.

En la terminal, dentro de la máquina virtual en la ruta *"/vagrant/sites/lfts.isw811.xyz"* ingresamos el siguiente comando:

>***php artisan vendor:publish***

esto lo realizamos con el fin de poder ser nosotros el propietario de la paginación para de esta manera poder modificarlo a nuestro antojo.

Por último, para terminar este capítulo, si queremos buscar una misma categoría en diferentes página del sitio solo debemos dirigirnos al controlador de los posts y donde agregamos el *paginate()* vamos a incluir *withQueryString()*, tal que así:

>***return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search', 'category', 'author'])
            )->paginate(3)->withQueryString()
        ]);***