<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Notifications\NewProductNotification;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_list_of_products_can_be_returned()
    {
        $products=Product::factory(10)->create();
        $response = $this->getJson('/products');
        $response->assertOk()
                 ->assertJsonStructure([
                    'products'=>$products
                 ]);
    }

    public function test_product_create_page_can_be_rendered()
    {
        $response = $this->get('/product/create');
        $response->assertOk();
    }

    public function test_categories_are_available_on_product_create_page()
    {
        $categories=Category::factory(20)->create();
        $response = $this->get('/product/create');
        $response->assertViewHas('product.create', function() use($categories){
          return $categories;
        });
    }

    public function test_product_create_page_rendered_only_for_authenticated_users()
    {
       $response=$this->get('/product/create');
       $response->assertRedirect('/login');
    }

    public function test_only_authenticated_users_can_add_new_product()
    {
        $response=$this->post('/product/store');
        $response->assertUnauthorized();
    }

    public function test_authenticated_user_can_add_new_product()
    {
        $user=User::factory()->create();
        $this->actingAs($user);
        $product=Product::factory()->create();
        $response=$this->post('/product/store',['product'=>$product]);
        $this->assertDatabaseCount('products',1);
        $this->assertDatabaseHas('products',['id'=>$product->id]);
        Notification::fake();
        $users=$product->users();
        foreach ($users as $user) {
          Notification::assertSentTo($user->email,NewProductNotification::class);
        }
        $response->assertRedirect('home');
    }

    public function test_product_show_page_can_be_rendered()
    {
       $product=Product::factory()->create();
       $response=$this->get("/product/$product->id/show");
       $response->assertOk();
    }

    public function test_categories_are_available_on_product_show_page()
    {
        $products=Product::factory(20)->create();
        $product=$products->first();
        $category=$product->category;
        $recommendedProducts=$category->products()->latest()->take(20)->get();
        $response=$this->get("/product/$product->id/show");
        $response->assertViewHas('product.show',function() use($recommendedProducts){
          return $recommendedProducts;
        });
    }

    public function test_unauthorized_user_can_not_edit_product()
    {
       $product=Product::factory()->create(['user_id'=>1]);
       $user=User::factory()->create(['id'=>2]);
       $this->actingAs($user);
       $response=$this->get("/product/$product->id/edit");
       $response->assertUnauthorized();
    }

    public function test_categories_are_available_on_product_edit_page()
    {
      $user=User::factory()->create(['id'=>1]);
      $this->actingAs($user);
      $product=Product::factory()->create(['user_id'=>1]);
      $categories=Category::factory(10)->create();
      $response=$this->get("/product/$product->id/edit");
      $response->assertViewHas('product.edit',function() use($categories){
        return $categories;
      });
    }

    public function test_authorized_user_can_update_product(){
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $product=Product::factory()->create(['user_id'=>1,'name'=>'product name','description'=>'description']);
        $updatedData=['name'=>'updated product name','description'=>'updated description'];
        $response=$this->patch("/product/$product->id/update",$updatedData);
        $this->assertEquals($product->name,$updatedData['name']);
        $response->assertRedirect('home');
    }

    public function test_product_can_be_deleted()
    {   $product=Product::factory()->create();
        $response=$this->delete("/product/$product->id/delete");
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseCount('products',0);
        $this->assertDatabaseMissing('products',['id'=>$product->id]);
    }

    public function test_product_can_be_searched()
    {
       $searchQuery='shoes';
       $data=[
        'categoryId'=>1,
        'searchQuery'=>$searchQuery
       ];
       $products=Product::factory(5)->create(['name'=>$searchQuery]);
       $response=$this->post('/product/search',$data);
       $response->assertViewIs('product.search')
                ->assertViewHasAll([
                    'products'=>$products,
                    'searchQuery'=>$searchQuery
                ]);
    }

    public function test_product_data_can_be_returned()
    {
      $product=Product::factory()->create();
      $response=$this->get('/product/data',['productId'=>$product->d]);
      $response->assertExactJson([
        'product'=>$product
      ]);
    }

    public function test_authenticated_user_can_see_saved_products()
    {
        $user=User::factory()->create();
        $this->actingAs($user);
        $products=Product::factory(5)->create(['user_id'=>$user->id,'type'=>'saved']);
        $response=$this->get('/product/savedProducts',['userId'=>$user->id]);
        $response->assertExactJson([
            'products'=>$products
        ]);
    }
}
