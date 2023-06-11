<?php

namespace Tests\Unit;

use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testGetCategories()
    {
        $cant = 3;
        $categories = Category::factory($cant)->create([
            'status' => true
        ]);
        $response = $this->get('api/category');
        $response->assertStatus(200);
        $this->assertJson(json_encode($categories), $response->getContent());
        $responseCategories = json_decode($response->getContent(), true);
        $this->assertJson($categories->count(), count($responseCategories));
        $this->assertJson($cant, count($responseCategories));
    }

    public function testShowCategory()
    {
        $cant = 3;
        Category::factory($cant)->create([
            'status' => true
        ]);
        $category = Category::factory()->create([
            'status' => true
        ]);
        $response = $this->get("api/category/{$category->id}");
        $response->assertStatus(200);
        $this->assertJson(json_encode($category), $response->getContent());
    }
}
