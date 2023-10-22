<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CommentModelTest extends TestCase
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

        $user = User::factory()->create();
        $comment = Comment::factory()->for($user)->create();

        $this->assertEquals($user->name, $comment->user->name);
    }
}
