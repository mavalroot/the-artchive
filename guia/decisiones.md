# Decisiones adoptadas

- Se usará la tabla "user" que nos proporciona la plantilla avanzada de yii2 para almacenar los datos de registro, y la tabla usuarios_datos se usará para almacenar los datos personales de cada usuario.
- Se ha creado una VIEW usuarios_completo que mezclará ambas partes de usuarios para facilitar la visualización.
- Para crear los árboles genealógicos no se creará una tabla como tal, sino que con la tabla de relaciones se irán formando.
- El email del usuario será privado (sólo el dueño de la cuenta puede ver su propio email).
- El id del usuario no será visible siempre que pueda evitarse, se usará el username como parámetro.
- Para la baja de usuario se comenzó construyendo el deleteAccount directamente en site y siteController, pero se tomó la decisión de apartarlo para mayor eficencia, creando la vista delete-account y su propio controlador.
- Para las búsquedas, igual que las bajas de usuario, se comenzó construyendo directamente en site y site controller, pero se tomó la decisión de apartarlo para mayor eficiencia.
- Se tomó la decisión de cambiar la forma en la que se visualizaban los comentarios y la forma de éstos.
- Se tomó la decisión de hacer un "infinite scroll" en el Inicio para las publicaciones, tipo twitter, en vez de un paginador.
