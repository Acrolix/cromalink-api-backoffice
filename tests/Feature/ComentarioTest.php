<?php

namespace Tests\Unit;

use App\Models\Comentario;
use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ComentarioTest extends TestCase
{
    use DatabaseTransactions;

    public function test_listar_comentarios()
    {
        $user = User::factory()->create();
        $publication = Publicacion::factory()->create(['created_by' => $user->id]);
        $comments = Comentario::factory(5)->create([
            'publication_id' => $publication->id,
            'created_by' => $user->id
        ]);

        $response = $this->getJson("/api/comentarios/{$publication->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'publication_id',
                    'created_by',
                    'content',
                    'created_at',
                    'updated_at',
                ]
            ]);

        foreach ($comments as $comment) {
            $response->assertJsonFragment([
                'id' => $comment->id,
                'publication_id' => $comment->publication_id,
                'created_by' => $comment->created_by,
                'content' => $comment->content,
            ]);
        }
    }

    public function test_crear_comentario()
    {
        $user = User::factory()->create();
        $publication = Publicacion::factory()->create(['created_by' => $user->id]);

        $response = $this->postJson('/api/comentarios', [
            'publication_id' => $publication->id,
            'created_by' => $user->id,
            'content' => 'Este es un comentario de prueba',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'publication_id',
                'created_by',
                'content',
                'created_at',
                'updated_at',
            ])
            ->assertJsonFragment([
                'publication_id' => $publication->id,
                'created_by' => $user->id,
                'content' => 'Este es un comentario de prueba',
            ]);

        $this->assertDatabaseHas('comments', [
            'publication_id' => $publication->id,
            'created_by' => $user->id,
            'content' => 'Este es un comentario de prueba',
        ]);
    }

    public function test_actualizar_comentario()
    {
        $user = User::factory()->create();
        $publication = Publicacion::factory()->create(['created_by' => $user->id]);
        $comment = Comentario::factory()->create([
            'publication_id' => $publication->id,
            'created_by' => $user->id,
        ]);

        $response = $this->putJson("/api/comentarios/{$comment->id}", [
            'content' => 'Este es un comentario de prueba actualizado',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'publication_id',
                'created_by',
                'content',
                'created_at',
                'updated_at',
            ])
            ->assertJsonFragment([
                'id' => $comment->id,
                'publication_id' => $publication->id,
                'created_by' => $user->id,
                'content' => 'Este es un comentario de prueba actualizado',
            ]);

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'publication_id' => $publication->id,
            'created_by' => $user->id,
            'content' => 'Este es un comentario de prueba actualizado',
        ]);
    }

    public function test_eliminar_comentario()
    {
        $user = User::factory()->create();
        $publication = Publicacion::factory()->create(['created_by' => $user->id]);
        $comment = Comentario::factory()->create([
            'publication_id' => $publication->id,
            'created_by' => $user->id,
        ]);

        $response = $this->deleteJson("/api/comentarios/{$comment->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);
    }
}
