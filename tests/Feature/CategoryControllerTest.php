<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_can_list_categories()
    {

        // login and get token
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        Category::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->getJson(route('categories.index'));

        $response->assertOk()
        ->assertJsonStructure([
            '*' => ['id', 'name']
        ]);
    }

    #[Test]
    public function test_can_store_a_category()
    {
        // login and get token
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $data = [
            'name' => 'Test Category'
        ];

        $response =  $this->withHeader('Authorization', 'Bearer ' . $token)->postJson(route('categories.store'), $data);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name'
            ]);
    }

    #[Test]
    public function test_can_show_a_category()
    {
        // login and get token
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $category = Category::factory()->create(['user_id' => $user->id]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->getJson(route('categories.show', $category));

        $response->assertStatus(200)
        ->assertJsonStructure([
            'id',
            'name'
        ]);
    }

    #[Test]
    public function test_can_update_a_category()
    {
        // login and get token
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $category = Category::factory()->create(['user_id' => $user->id]);

        $data = $category->toArray();

        $response =  $this->withHeader('Authorization', 'Bearer ' . $token)->putJson(route('categories.update', $category), $data);

        $response->assertStatus(200)
        ->assertJsonStructure([
            'id',
            'name'
        ]);
    }

    #[Test]
    public function test_can_delete_a_category()
    {
         // login and get token
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $category = Category::factory()->create(['user_id' => $user->id]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->deleteJson(route('categories.destroy', $category));

        $response->assertNoContent();
    }
}
