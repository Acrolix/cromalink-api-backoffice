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

+--------+----------+------------------------+--------------------------+------------------------------------------------------------+------------+
| Domain | Method   | URI                    | Name                     | Action                                                     | Middleware |
+--------+----------+------------------------+--------------------------+------------------------------------------------------------+------------+
|        | POST     | api/comentarios        | comentarios.guardar      | App\Http\Controllers\ComentarioController@guardar          | api        |
|        | GET|HEAD | api/comentarios/{id}   | comentarios.listar       | App\Http\Controllers\ComentarioController@listar           | api        |
|        | PUT      | api/comentarios/{id}   | comentarios.actualizar   | App\Http\Controllers\ComentarioController@actualizar       | api        |
|        | DELETE   | api/comentarios/{id}   | comentarios.eliminar     | App\Http\Controllers\ComentarioController@eliminar         | api        |
|        | GET|HEAD | api/publicaciones      | publicaciones.filtrar    | App\Http\Controllers\PublicacionController@filtrar         | api        |
|        | POST     | api/publicaciones      | publicaciones.guardar    | App\Http\Controllers\PublicacionController@guardar         | api        |
|        | GET|HEAD | api/publicaciones/{id} | publicaciones.obtener    | App\Http\Controllers\PublicacionController@obtener         | api        |
|        | PUT      | api/publicaciones/{id} | publicaciones.actualizar | App\Http\Controllers\PublicacionController@actualizar      | api        |
|        | DELETE   | api/publicaciones/{id} | publicaciones.eliminar   | App\Http\Controllers\PublicacionController@eliminar        | api        |
|        | POST     | api/reacciones         | reacciones.setLike       | App\Http\Controllers\ReaccionController@setLike            | api        |
|        | DELETE   | api/reacciones/{id}    | reacciones.unsetLike     | App\Http\Controllers\ReaccionController@unsetLike          | api        |
+--------+----------+------------------------+--------------------------+------------------------------------------------------------+------------+
