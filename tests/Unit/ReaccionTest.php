<?php

namespace Tests\Unit;

use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ReaccionTest extends TestCase
{
    use DatabaseTransactions;

    
    public function test_reaccionar_a_publicacion()
    {
        $user = User::factory()->create();
        $publication = Publicacion::factory()->create(['created_by' => $user->id]);

        $response = $this->postJson('/api/reacciones', [
            'publication_id' => $publication->id,
            'reaction_by' => $user->id,
        ]);

        $response->assertStatus(201);
        
        $this->assertDatabaseHas('reactions', [
            'publication_id' => $publication->id,
            'reaction_by' => $user->id,
        ]);
    }

    public function test_quitar_reaccion_a_publicacion()
    {
        $user = User::factory()->create();
        $publication = Publicacion::factory()->create(['created_by' => $user->id]);

        $publication->reactions()->create([
            'reaction_by' => $user->id,
        ]);
        
        $response = $this->deleteJson('/api/reacciones/'. $publication->id, [
            'reaction_by' => $user->id,
        ]);
        $response->assertStatus(200);
        
        $this->assertDatabaseMissing('reactions', [
            'publication_id' => $publication->id,
            'reaction_by' => $user->id,
        ]);
    }
}
