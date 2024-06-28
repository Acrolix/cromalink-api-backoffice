<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicacionFactory extends Factory
{
    const imagenesEjemplo = [
        "https://unsplash.com/photos/2ShvY2N2S5I", // Pintura abstracta
        "https://unsplash.com/photos/7jZaa9y2tdo", // Escultura moderna
        "https://unsplash.com/photos/9HsgSrjfRmM", // Street art
        "https://unsplash.com/photos/pGcqwJksSgw", // Fotografía artística
        "https://unsplash.com/photos/W-jDdHe7bGo", // Diseño gráfico
        "https://unsplash.com/photos/jS8jW_N9ZOk", // Concierto musical
        "https://unsplash.com/photos/cCKESPqL79U", // Instrumentos musicales
        "https://unsplash.com/photos/j82Gmrh12wA", // Vinilos
        "https://unsplash.com/photos/aWXVxy8BSzc", // Partitura musical
        "https://unsplash.com/photos/zFnk_bTLApo", // Auriculares
        "https://unsplash.com/photos/o_Mf_FgvmsA", // Libros antiguos
        "https://unsplash.com/photos/zV_nrkC2M7Q", // Máquina de escribir
        "https://unsplash.com/photos/paWOb2LSM6U", // Biblioteca
        "https://unsplash.com/photos/Y9pWW-pkehQ", // Cita literaria
        "https://unsplash.com/photos/Y4kSdU7JtLg", // Pluma estilográfica
        "https://unsplash.com/photos/_dGsmC-jRkQ", // Cine al aire libre
        "https://unsplash.com/photos/4_hFxTsZlkI", // Cámara de cine antigua
        "https://unsplash.com/photos/ruJm3dBXC-M", // Rollo de película
        "https://unsplash.com/photos/Bg7xQE1bUTE", // Máscara teatral
        "https://unsplash.com/photos/2U2tFsdhWQk", // Escenario teatral
        "https://unsplash.com/photos/98yIYjSd-oE", // Bailarines de ballet
        "https://unsplash.com/photos/lT-njJpjecU", // Guitarra eléctrica (detalle)
        "https://unsplash.com/photos/f-yGo0yOdAQ", // DJ en festival musical
        "https://unsplash.com/photos/9CgpK_7TbVg", // Graffiti artístico en muro
        "https://unsplash.com/photos/j82Gmrh12wA", // Hombre leyendo un libro absorto
        "https://unsplash.com/photos/OQM2vduc-qo", // Mujer escribiendo en un cuaderno en un café
        "https://unsplash.com/photos/7VaimAjxn_8", // Primer plano de un libro abierto con luz cálida
    ];

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'image' => $this->faker->randomElement(self::imagenesEjemplo),
            'created_at' => $this->faker->dateTime(),
            'created_by' => $this->faker->numberBetween(1, User::count()),
        ];
    }
}
