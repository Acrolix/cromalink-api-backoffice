<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countrys = [
            [
                'name' => 'Estados Unidos',
                'code' => 'US',
            ],
            [
                'name' => 'México',
                'code' => 'MX',
            ],
            [
                'name' => 'Colombia',
                'code' => 'CO',
            ],
            [
                'name' => 'Argentina',
                'code' => 'AR',
            ],
            [
                'name' => 'España',
                'code' => 'ES',
            ],
            [
                'name' => 'Perú',
                'code' => 'PE',
            ],
            [
                'name' => 'Venezuela',
                'code' => 'VE',
            ],
            [
                'name' => 'Chile',
                'code' => 'CL',
            ],
            [
                'name' => 'Ecuador',
                'code' => 'EC',
            ],
            [
                'name' => 'Guatemala',
                'code' => 'GT',
            ],
            [
                'name' => 'Cuba',
                'code' => 'CU',
            ],
            [
                'name' => 'Bolivia',
                'code' => 'BO',
            ],
            [
                'name' => 'Honduras',
                'code' => 'HN',
            ],
            [
                'name' => 'Paraguay',
                'code' => 'PY',
            ],
            [
                'name' => 'El Salvador',
                'code' => 'SV',
            ],
            [
                'name' => 'Nicaragua',
                'code' => 'NI',
            ],
            [
                'name' => 'Costa Rica',
                'code' => 'CR',
            ],
            [
                'name' => 'Puerto Rico',
                'code' => 'PR',
            ],
            [
                'name' => 'Panamá',
                'code' => 'PA',
            ],
            [
                'name' => 'Uruguay',
                'code' => 'UY',
            ],
            [
                'name' => 'República Dominicana',
                'code' => 'DO',
            ],
            [
                'name' => 'Nicaragua',
                'code' => 'NI',
            ]
        ];

        foreach ($countrys as $country) {
            try {
                \App\Models\Country::create($country);
            } catch (\Exception $e) {
                continue;
            }
        }
    }
}
