# Laravel from the scratch

En esta sección vamos a trabajar con comentarios.

--------------------------------------------------------

## **Primera parte**
### Escribir el marcado para un comentario de publicación:
--------------------------------------------------------

Para empezar, en este capítulo, nos vamos a dirigir a donde cierra el *"article"* y vamos a establecer una etiqueta *"section"*,
dentro de este *"section"* abriremos otro *"article"* y este será de clase *"flex"*, seguidamente abrimos 2 etiquetas *"div"* y en una de ellas estableceremos un avatar, de momento no lo tenemos, entonces vamos a cargar un link que nos va a propiciar una imagen random para nuestro avatar.
Entonces tendremos lo siguiente:

        <section>
            <article class="flex">
                <div>
                    <img src="https://i.pravatar.cc/100" alt="">
                </div>
                
                <div></div>
            </article>
        </section>

Luego en la sección principal, es decir, dentro de nuestra segunda etiqueta *"div"* abriremos un *"header"* y establecemos un encabezado:

        <section>
            <article class="flex">
                <div>
                    <img src="https://i.pravatar.cc/100" alt="">
                </div>
                
                <div>
                    <header>
                        <h3 class="font-bold">Jenhson Lizano</h3>
                        <p class="text-xs">Posted
                        <time>8 months ago</time></p>
                    </header>
                </div>
            </article>
        </section>

Luego establecemos un comentario random debajo del *"header"*

        <section>
            <article class="flex">
                <div>
                    <img src="https://i.pravatar.cc/100" alt="">
                </div>
                
                <div>
                    <header>
                        <h3 class="font-bold">Jenhson Lizano</h3>
                        <p class="text-xs">Posted
                        <time>8 months ago</time></p>
                    </header>
                     <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    </p>
                </div>
            </article>
        </section>

Al implementar el código anterior, podemos observer que este al momento de ser renderizado en el navegador no tiene un estilo, para eso solo vamos a la parte de *"section"* y le damos un class, tal que así:

        <section class="col-span-8 col-start-5 mt-10">
            <article class="flex">
                <div>
                    <img src="https://i.pravatar.cc/100" alt="">
                </div>
                
                <div>
                    <header>
                        <h3 class="font-bold">Jenhson Lizano</h3>
                        <p class="text-xs">Posted
                        <time>8 months ago</time></p>
                    </header>
                     <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    </p>
                </div>
            </article>
        </section>

y seguimos dandole diseño a este comentario que hemos creado.
Una vez que tenemos todo el artículo completo, lo vamos a cortar y lo vamos a colocar en un archivo aparte para que este pueda ser usado en otros sitios de la app, tal como hicimos con los posts, etc... y una vez hecho esto, podremos ver nuestro comentario recién creado en los diferentes *posts* de nuestra app.