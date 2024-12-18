<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_list_categories()
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson(route('categories.index'));

        $response->assertOk()
        ->assertJsonStructure([
            '*' => ['id', 'name']
        ]);
    }

    #[Test]
    public function it_can_store_a_category()
    {
        $data = Category::factory()->make()->toArray();

        $response = $this->postJson(route('categories.store'), $data);

        $response->assertCreated()
            ->assertJsonStructure([
                'id',
                'name'
            ]);
    }

    #[Test]
    public function it_can_show_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->getJson(route('categories.show', $category));

        $response->assertOk()
                ->assertJsonPath('id', $category->id);
    }

    #[Test]
    public function it_can_update_a_category()
    {
        $category = Category::factory()->create();
        $data = Category::factory()->make()->toArray();

        $response = $this->putJson(route('categories.update', $category), $data);

        $response->assertOk()
            ->assertJsonPath('name', $data['name']);
    }

    #[Test]
    public function it_can_delete_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson(route('categories.destroy', $category));

        $response->assertNoContent();
    }
}
