<?php

namespace Tests\Feature;

use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PublicacionTest extends TestCase
{
    use DatabaseTransactions;

    public function test_filtrar_publicaciones_sin_filtro()
    {
        $user = User::factory()->create();
        $publicacion = Publicacion::factory(20)->create(['created_by' => $user->id]);

        $response = $this->getJson('/api/publicaciones');

        $response->assertStatus(200)
            ->assertJsonCount(20, 'data')
            ->assertJsonPath('data.0.created_by.id', $user->id)
            ->assertJsonPath('total', 20);

        $response2 = $this->getJson('/api/publicaciones?title=../../../etc/passwd');
        $response2->assertStatus(404)
            ->assertJsonCount(0, 'data');
    }

    public function test_filtrar_publicaciones_por_titulo()
    {
        $user = User::factory()->create();
        $publicacion = Publicacion::factory()->create(['created_by' => $user->id]);

        $response = $this->getJson('/api/publicaciones?title=' . $publicacion->title);

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.title', $publicacion->title);

        $response2 = $this->getJson('/api/publicaciones?title=../../../etc/passwd');
        $response2->assertStatus(404)
            ->assertJsonCount(0, 'data');
    }

    public function test_filtrar_publicaciones_por_contenido()
    {
        $user = User::factory()->create();
        $publicacion = Publicacion::factory()->create(['created_by' => $user->id]);

        $response = $this->getJson('/api/publicaciones?contenido=' . $publicacion->content);

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.content', $publicacion->content);
    }

    public function test_filtrar_publicaciones_por_usuario()
    {
        $user = User::factory()->create();
        $publicacion = Publicacion::factory()->create(['created_by' => $user->id]);

        $response = $this->getJson('/api/publicaciones?usuario=' . $user->id);

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.created_by.id', $user->id);

        $response2 = $this->getJson('/api/publicaciones?usuario=999999');
        $response2->assertStatus(404)
            ->assertJsonCount(0, 'data');;
    }

    public function test_guardar_publicacion()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/publicaciones', [
            'title' => 'Título de prueba',
            'content' => 'Contenido de prueba',
            'created_by' => $user->id,
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'title' => 'Título de prueba',
                'content' => 'Contenido de prueba',
                'created_by' => $user->id,
            ]);

        $this->assertDatabaseHas('publications', [
            'title' => 'Título de prueba',
            'content' => 'Contenido de prueba',
            'created_by' => $user->id,
        ]);
    }

    public function test_obtener_publicacion()
    {
        $user = User::factory()->create();
        $publicacion = Publicacion::factory()->create(['created_by' => $user->id]);

        $response = $this->getJson('/api/publicaciones/' . $publicacion->id);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'title' => $publicacion->title,
                'content' => $publicacion->content,
                'created_by' => $user->id,
            ]);

        $response2 = $this->getJson('/api/publicaciones/999999');
        $response2->assertStatus(404);
    }

    public function test_actualizar_publicacion()
    {
        $user = User::factory()->create();
        $publicacion = Publicacion::factory()->create(['created_by' => $user->id]);

        $response = $this->putJson('/api/publicaciones/' . $publicacion->id, [
            'title' => 'Título de prueba',
            'content' => 'Contenido de prueba',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'Título de prueba',
                'content' => 'Contenido de prueba',
                'created_by' => $user->id,
            ]);

        $this->assertDatabaseHas('publications', [
            'title' => 'Título de prueba',
            'content' => 'Contenido de prueba',
            'created_by' => $user->id,
        ]);
        

    }

    public function test_eliminar_publicacion()
    {
        $user = User::factory()->create();
        $publicacion = Publicacion::factory()->create(['created_by' => $user->id]);

        $response = $this->deleteJson('/api/publicaciones/' . $publicacion->id);    

        $response->assertStatus(204);

        $this->assertDatabaseMissing('publications', [
            'id' => $publicacion->id,
        ]);
    }
}
