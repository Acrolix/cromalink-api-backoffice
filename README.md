La Base de datos de encuentra en el Repositorio DevEnv (https://github.com/Acrolix/DevEnv).
Ahí se encontrara un docker compose con la puesta a punto de un docker MySQL con la base de datos incializada.

Una ves montada la base de datos, es posible desplegar la aplicacion.

En primera instancia se corren los test para verificar que todo este correctamente.
    - ``php artisan test``

Luego podemos ejecutar los Seeder en el siguiente orden.
    - ``php artisan db:seed UserSeeder``
    - ``php artisan db:seed PublicacionSeeder``
    - ``php artisan db:seed ReaccionSeeder``
    - ``php artisan db:seed ComentarioSeeder``

El caso de Usuario solo se puede ejecutar 1 vez, dado que estan predefinidos, en el resto de los Seeder, no importa las veces que se ejecuten, Multiplica los registros.

## Tabla de Rutas API

| Método  | URI                      | Nombre                      | Acción                                                            | Middleware |
|---------|---------------------------|-------------------------------|-------------------------------------------------------------------|------------|
| POST     | api/comentarios         | comentarios.guardar           | ComentarioController@guardar                | api        |
| GET\|HEAD | api/comentarios/{id}      | comentarios.listar            | ComentarioController@listar                  | api        |
| PUT      | api/comentarios/{id}      | comentarios.actualizar        | ComentarioController@actualizar              | api        |
| DELETE   | api/comentarios/{id}      | comentarios.eliminar          | ComentarioController@eliminar                | api        |
| GET\|HEAD | api/publicaciones       | publicaciones.filtrar         | PublicacionController@filtrar                | api        |
| POST     | api/publicaciones       | publicaciones.guardar         | PublicacionController@guardar                | api        |
| GET\|HEAD | api/publicaciones/{id}   | publicaciones.obtener         | PublicacionController@obtener                | api        |
| PUT      | api/publicaciones/{id}   | publicaciones.actualizar      | PublicacionController@actualizar             | api        |
| DELETE   | api/publicaciones/{id}   | publicaciones.eliminar        | PublicacionController@eliminar               | api        |
| POST     | api/reacciones          | reacciones.setLike            | ReaccionController@setLike                   | api        |
| DELETE   | api/reacciones/{id}     | reacciones.unsetLike          | ReaccionController@unsetLike                 | api        |


