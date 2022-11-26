<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_and_categories_data_are_available_on_navigation()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $response = $this->get('/navigation',['userId'=>$user->id]);
        $response->assertOk()
                 ->assertJsonStructure([
                    'user','categories','notifications'
                 ]);
    }

    public function test_auhtenticated_user_can_get_database_notifications()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $response=$this->get('/notifications');
        $response->assertOk()
                 ->assertJsonStructure([
                   'notifications'
                 ]);
    }

    public function test_auhtenticated_user_can_mark_as_read_notification()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $response=$this->get('/notification/read');
        $response->assertOk();
    }

    public function test_authenticated_user_can_report_product()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $product=Product::factory()->create();
        $reportText="inappropriate price";
        $response=$this->post('/report',[
            'userId'=>$user->id,
            'productId'=>$product->id,
            'reportText'=>$reportText
        ]);
        $response->assertOk()
                 ->assertJsonStructure([
                    'message'=>'report was succesfull'
                 ]);
    }

    public function test_()
    {
        
    }
}
