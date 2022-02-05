<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class UserModelTest extends TestCase
{

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testGetFullName()
    {
        $user = User::factory()->make([
            'name' => 'Joe',
            'surname' => 'Trebeane'
        ]);

        $this->assertEquals('Joe Trebeane', $user->getFullName());
    }

    public function testIsAdmin()
    {
        $user = User::factory()->make([
            'role' => 'admin',
        ]);

        $this->assertTrue($user->isAdmin());
    }

    public function testIsUser()
    {
        $user = User::factory()->make([
            'role' => 'user'
        ]);

        $this->assertTrue($user->isUser());
    }

    public function testUserPosts()
    {
        $user = User::factory()
            ->has(Post::factory()->count(3))
            ->create();

        $this->assertJson($user->posts);
    }

    public function testUserComments()
    {
        $user = User::factory()
            ->has(Comment::factory()->count(3))
            ->create();

        $this->assertJson($user->comments);
    }
}
