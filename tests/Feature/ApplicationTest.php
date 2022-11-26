<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_products_are_available_on_home_page()
    {
        $products=Product::factory(30)->create();
        $response=$this->get('/');
        $response->assertOk();
        $response->assertViewHas('home',function()use($products){
            return $products;
        });
    }

    public function test_about_page_can_be_rendered()
    {
        $response=$this->get('/about');
        $response->assertOk();
    }
}
