<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    
    public function test_unauthenticated_user_can_not_make_order()
    {
        $response = $this->get('/order');
        $response->assertRedirect('/login');
    }

    public function test_order_create_page_can_be_rendered_for_authenticated_user()
    {
        $user=User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/order');
        $response->assertOk();
    }

    public function test_unauthenticated_user_can_not_see_orders()
    {
        $response = $this->get('/orders');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_see_orders_page()
    {
        $user=User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/orders');
        $response->assertOk();
    }

    public function test_orders_are_available_on_orders_page()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $orders=$user->orders();
        $response=$this->get('/orders');
        $response->assertViewHas('orders',function() use($orders){
          return $orders;
        });
    }

    public function test_authenticated_user_can_order_product()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $orderItems=Product::factory(3)->create();
        $response=$this->post('/order',['orderItems'=>$orderItems]);
        $this->assertDatabaseCount('order_product',3);
        $this->assertDatabaseCount('order_user',1);
        $response->assertRedirect('/orders');
    }

    public function test_()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $order=Order::factory()->create(['user_id'=>$user->id]);
        $response=$this->delete('/order/complete',['orderId'=>$order->id]);
        $this->assertDatabaseCount('orders',0);
        $this->assertDatabaseCount('order_user',0);
    }
}
