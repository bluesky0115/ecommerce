<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    
    public function test_products_of_a_specific_category_can_be_returned()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $category=Category::factory()->create();
        $products=Product::factory(5)->create(['category_id'=>$category->id]);
        $response = $this->get('/category/product');
        $response->assertStatus(200);
        $response->assertViewHas('category.specific',function($user,$products){
           return $products && $user;
        });
    }

    public function test_categories_can_be_returned()
    {
        $category=Category::factory(5)->create();
        $response=$this->get('/categories');
        $response->assertOk()
                 ->assertExactJson([
                    'categories'=>$categories
                 ]);
    }

}
