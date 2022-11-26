<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_only_authenticated_users_have_previliges_related_to_cart()
    {
        $response = $this->get('/profile/*')->whereIn('*',['create','store','edit','update']);
        $response->assertRedirect('/login');
    }

    public function test_cart_items_of_authenticated_user_can_be_listed()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $cart=Cart::factory()->create(['user_id'=>$user->id]);
        $response=$this->get('/cartitems');
        $response->assertJsonStructure('cartItems');
    }

    public function test_authenticated_user_can_add_product_to_cart()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $product=Product::factory()->create();
        $response=$this->post('cart/addproduct',[
          'userId'=>$user->id,
          'productId'=>$product->id
        ]);
        $response->assertOk();
        $this->assertDatabaseCount('cart_product',1);
    }

    public function test_authenticated_user_can_remove_product_from_cart()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $product=Product::factory()->create();
        $cart=Cart::factory()->create(['user_id'=>$user->id]);
        $response=$this->post('cart/addproduct',[
          'userId'=>$user->id,
          'productId'=>$product->id
        ]);
        $response->assertOk();
        $this->assertDatabaseCount('cart_product',1);
        $response=$this->post('cart/removeproduct',[
          'userId'=>$user->id,
          'productId'=>$product->id
        ]);
        $response->assertOk();
        $this->assertDatabaseMissing('cart_product',[
            'cart_id'=>$cart->id,
            'product_id'=>$product->id
        ]);
        $this->assertDatabaseCount('cart_product',0);
    }

    public function test_product_added_to_cart_is_available_in_cart()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $product=Product::factory()->create();
        $response=$this->get('cart/product',[
            'userId'=>$user->id,
            'productId'=>$product->id
        ]);
        $response->assertOk()
                 ->assertJsonCount(1,'productInCart');
    }
}
