<?php

use App\Models\Genre;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Genre::all() as $genre) {
            foreach (User::all() as $user) {
                factory(Book::class, 1)->create([
                    'genre_name' => $genre->name,
                    'publisher_id' => $user->id,
                ]);
            }
        }

    }
}
