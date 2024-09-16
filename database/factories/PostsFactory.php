<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicacionFactory extends Factory
{
    // 20 imagenes de ejemplo reales para Posts

    const imagenesEjemplo = [
        "https://plus.unsplash.com/premium_photo-1674898513923-ff73b9d830ed?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        "https://images.unsplash.com/photo-1622279486466-e0e3bfdd0a01?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        "https://plus.unsplash.com/premium_photo-1670745084868-7b4f727cc934?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        "https://plus.unsplash.com/premium_photo-1670267552055-8f33a55c1af0?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        "https://images.unsplash.com/photo-1527922891260-918d42a4efc8?q=80&w=2091&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        "https://images.unsplash.com/photo-1463559830741-e117d53be7c0?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        "https://plus.unsplash.com/premium_photo-1661429571803-32c647db5a14?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        "https://images.unsplash.com/photo-1533551268962-824e232f7ee1?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        "https://plus.unsplash.com/premium_photo-1695800038830-7586a9806569?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        "https://images.unsplash.com/photo-1530244534845-4a0c319f41e3?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        "https://images.unsplash.com/photo-1524414621493-7dec026782c3?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
    ];

    // 50 ejemplos de titulos para publicaciones de red socioal cultural, que sean cortos, no mas de 5 palabras
    const titleEjemplo = [
        "Hola Mundo",
        "Buenos Dias",
        "Buenas Tardes",
        "Buenas Noches",
        "Feliz Cumpleaños",
        "Feliz Navidad",
        "Feliz Año Nuevo",
        "Feliz Dia de la Madre",
        "Feliz Dia del Padre",
        "Feliz Dia del Niño",
        "Feliz Dia del Amor",
        "Feliz Dia del Estudiante",
        "Feliz Dia del Trabajador",
        "Feliz Dia del Maestro",
        "Feliz Dia del Medico",
        "Feliz Dia del Enfermero",
        "Feliz Dia del Abogado",
        "Feliz Dia del Ingeniero",
        "Feliz Dia del Arquitecto",
        "Feliz Dia del Contador",
        "Feliz Dia del Economista",
        "Feliz Dia del Administrador",
        "Feliz Dia del Psicologo",
        "Feliz Dia del Nutriologo",
        "Feliz Dia del Odontologo",
        "Feliz Dia del Veterinario",
        "Feliz Dia del Biologo",
        "Feliz Dia del Quimico",
        "Feliz Dia del Fisico",
        "Feliz Dia del Matematico",
        "Feliz Dia del Filosofo",
        "Feliz Dia del Historiador",
        "Feliz Dia del Geografo",
        "Feliz Dia del Sociologo",
        "Feliz Dia del Antropologo",
        "Feliz Dia del Psicopedagogo",
        "Feliz Dia del Pedagogo",
        "Feliz Dia del Profesor",
        "Feliz Dia del Maestro",
        "Feliz Dia del Instructor",
        "Feliz Dia del Capacitador",
        "Feliz Dia del Tutor",
        "Feliz Dia del Mentor",
        "Feliz Dia del Coach",
        "Feliz Dia del Guia",
        "Feliz Dia del Lider",
        "Feliz Dia del Jefe",
        "Feliz Dia del Director",
        "Feliz Dia del Gerente",
        "Feliz Dia del Supervisor",
        "Feliz Dia del Coordinador",
        "Feliz Dia del Analista",
        "Feliz Dia del Programador",
        "Feliz Dia del Desarrollador",
    ];

    public function definition()
    {
        return [
            'title' => $this->faker->randomElement(self::titleEjemplo),
            'content' => $this->faker->paragraph(),
            'published_by' => User::all()->random()->id,
        ];
    }
}
