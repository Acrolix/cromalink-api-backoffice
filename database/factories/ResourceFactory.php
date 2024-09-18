<?php

namespace Database\Factories;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = $this->faker->randomElement(['image', 'video', 'audio', 'external']);

        switch ($types) {
            case 'image':
                return [
                    'publication_id' => Publication::all()->random()->id,
                    'type' => 'image',
                    'url' => $this->faker->imageUrl(),
                ];
                break;
            case 'video':
                return [
                    'publication_id' => Publication::all()->random()->id,
                    'type' => 'video',
                    'url' => $this->faker->videoUrl(),
                ];
                break;
            case 'audio':
                return [
                    'publication_id' => Publication::all()->random()->id,
                    'type' => 'audio',
                    'url' => $this->faker->audioUrl(),
                ];
                break;
            case 'external':
                return [
                    'publication_id' => Publication::all()->random()->id,
                    'type' => 'external',
                    'url' => $this->faker->url(),
                ];
                break;

            default:
                return [
                    'publication_id' => Publication::all()->random()->id,
                    'type' => 'image',
                    'url' => $this->faker->imageUrl(),
                ];
                break;
        }
    }
}
