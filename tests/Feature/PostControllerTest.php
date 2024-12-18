<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate'); // Run the migrations
    }

    #[Test]
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    #[Test]
    public function test_can_display_all_post(): void
    {
        // create 10 posts
        Post::factory()->count(10)->create();

        $response = $this->getJson(route('posts.index'));

        $response->assertOk()
            ->assertJsonCount(10)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'title',
                    'body',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }

    #[Test]
    public function test_create_post(): void
    {
        $postData = [
            'author' => 'John Doe',
            'title' => 'Test Post',
            'body' => 'This is a test post body.',
        ];

        $response = $this->postJson(route('posts.store'), $postData);

        $response->assertStatus(201);
        $response->assertJson([
            'author' => 'John Doe',
            'title' => 'Test Post',
            'body' => 'This is a test post body.',
        ]);
    }

    #[Test]
    public function test_read_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->getJson(route('posts.show', $post));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'author',
            'title',
            'body',
            'created_at',
            'updated_at',
        ]);
    }

    #[Test]
    public function test_update_post(): void
    {
        $post = Post::factory()->create();
        $updateData = [
            'author' => 'John Doe',
            'title' => 'Updated Test Post',
            'body' => 'This is updated test post body.',
        ];

        $response =  $this->putJson(route('posts.update', $post), $updateData);

        $response->assertStatus(200);
        $response->assertJson([
            'author' => 'John Doe',
            'title' => 'Updated Test Post',
            'body' => 'This is updated test post body.',
        ]);
    }

    #[Test]
    public function test_delete_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->deleteJson(route('posts.destroy', $post));

        $response->assertStatus(204);

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
