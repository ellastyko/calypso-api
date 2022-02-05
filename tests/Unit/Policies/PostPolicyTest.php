<?php

namespace Tests\Unit\Policies;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PostPolicyTest extends TestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->random_user = User::factory()->make(['id' => 100]);
        $this->post_author = User::factory()->make(['id' => 200]);
        $this->admin = User::factory()->make([
            'role' => 'admin'
        ]);
        $this->post = Post::factory()->make([
            'user_id' => $this->post_author->id
        ]);
    }


    public function testUpdate()
    {
        $ByAdmin = $this->admin->can('update', $this->post);
        $ByPostAuthor = $this->post_author->can('update', $this->post);
        $ByRandomUser = $this->random_user->can('update', $this->post);

        $this->assertTrue($ByAdmin);
        $this->assertTrue($ByPostAuthor);
        $this->assertFalse($ByRandomUser);
    }

    public function testDelete()
    {
        $ByAdmin = $this->admin->can('delete', $this->post);
        $ByPostAuthor = $this->post_author->can('delete', $this->post);
        $ByRandomUser = $this->random_user->can('delete', $this->post);

        $this->assertTrue($ByAdmin);
        $this->assertTrue($ByPostAuthor);
        $this->assertFalse($ByRandomUser);
    }
}
