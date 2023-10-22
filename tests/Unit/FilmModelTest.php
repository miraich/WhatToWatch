<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Film;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class FilmModelTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {


        DB::table('roles')->insert([
            'name' => 'user',
            'name' => 'moderator',
        ]);


        $film = Film::factory()->create();
        Comment::factory(5)->for($film)->sequence(['rating' => 2], ['rating' => 1], ['rating' => 3],
            ['rating' => 6], ['rating' => 1])->create();

        $this->assertEquals(2.6, $film->rating);
    }
}
