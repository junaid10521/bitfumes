<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('books')->truncate();
        \App\Models\Book::factory()->count(50)->create();
    }
}
