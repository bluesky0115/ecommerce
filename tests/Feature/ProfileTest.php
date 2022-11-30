<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    
    public function test_only_authenticated_users_have_previliges_related_to_profile()
    {
        $response = $this->get('/profile/*')->whereIn('*',['create','store','edit','update']);
        $response->assertRedirect('/login');
    }

    public function test_create_profile_page_can_be_rendered()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $response=$this->get('/profile/create');
        $response->assertOk();
        $categories=Category::factory(5)->create();
        $response->assertViewHas('product.create',function() use($categories){
          return $categories;
        });
    }

    public function test_authenticated_user_can_create_profile()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $data=[
          'phone_number'=>'0000000000',
          'city'=>'city',
          'street'=>'street',
          'categories'=>['1','2','3']
        ];
        $response=$this->get('/profile/store',$data);
        $response->assertOk();
        $this->assertDatabaseCount('profiles',1);
        $this->assertDatabaseCount('carts',1);
        $this->assertDatabaseCount('category_user',3);
        $response->assertRedirect(RouteServiceProvider::HOME);
        $response->assertSessionHas('message','profile saved');
    }

    public function test_authenticated_user_can_edit_profile()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $categories=Category::factory(3)->create();
        $response=$this->get('/profile/edit');
        $response->assertOk();
        $response->assertViewHas('product.edit',function() use($categories){
          return $categories;
        });
    }

    public function test_authenticated_user_can_update_profile()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $categories=Category::factory(3)->create();
        $data=[
          'phone_number'=>'1111111111',
          'city'=>'new city',
          'street'=>'new street',
          'categories'=>['1','2']
        ];
        $response=$this->get('/profile/update',$data);
        $this->assertEquals($user->phone_number,$data['phone_number']);
        $this->assertEquals($user->city,$data['city']);
        $this->assertEquals($user->street,$data['street']);
        $this->assertEquals($user->categorie,$data['categories']);
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
