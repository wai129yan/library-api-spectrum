<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Author::factory(10)->create();

        // Book::factory(30)
        //     ->sequence(fn () => [
        //         'author_id' => Author::query()->inRandomOrder()->value('id'),
        //     ])
        //     ->create();
    }
}
