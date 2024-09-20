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
        $videos = [
            'https://www.w3schools.com/html/mov_bbb.mp4',
            'https://www.w3schools.com/html/mov_bbb.ogg',
        ];

        $videosExternal = [
            'https://www.youtube.com/watch?v=9bZkp7q19f0',
            'https://www.youtube.com/watch?v=J---aiyznGQ',
            'https://www.youtube.com/watch?v=2ZIpFytCSVc',
            'https://www.youtube.com/watch?v=3JZ_D3ELwOQ',
            'https://www.youtube.com/watch?v=4iVW7OhZ0p8',
            'https://www.youtube.com/watch?v=5f5T0kWJUjw',
            'https://www.youtube.com/watch?v=6Zbi0XmGtMw',
            'https://www.youtube.com/watch?v=7wtfhZwyrcc',
            'https://www.youtube.com/watch?v=8hM8v_9Zkz0',
        ];

        $audios = [
            'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
            'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3',
            'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3',
            'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3',
            'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3',
            'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-6.mp3',
            'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-7.mp3',
            'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-8.mp3',
            'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-9.mp3',
        ];

        do {
            $publication = Publication::all()->random();
            $resources = $publication->resources()->count();
        } while ($resources >= 5);

        $types = $this->faker->randomElement(['image', 'video', 'audio', 'external']);

        switch ($types) {
            case 'image':
                return [
                    'publication_id' => $publication->id,
                    'type' => 'image',
                    'url' => $this->faker->imageUrl(),
                ];
                break;
            case 'video':
                return [
                    'publication_id' => $publication->id,
                    'type' => 'video',
                    'url' => $this->faker->randomElement($videos),
                ];
                break;
            case 'audio':
                return [
                    'publication_id' => $publication->id,
                    'type' => 'audio',
                    'url' => $this->faker->randomElement($audios),
                ];
                break;
            case 'external':
                return [
                    'publication_id' => $publication->id,
                    'type' => 'external',
                    'url' => $this->faker->randomElement($videosExternal),
                ];
                break;

            default:
                break;
        }
    }
}
