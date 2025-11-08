<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BookType;

class BookTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookTypes = [
            ['name' => 'pret'],
            ['name' => 'vente'],
            ['name' => 'exchange'],
        ];

        foreach ($bookTypes as $type) {
            BookType::create($type);
        }
    }
}
