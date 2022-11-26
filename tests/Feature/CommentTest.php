<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_only_authenticated_users_have_previliges_to_add_update_and_delete_cart()
    {
        $response = $this->get('/comment/{any}')->whereIn('any',['store','update','update']);
        $response->assertRedirect('/login');
    }

    public function test_user_can_see_product_comments()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $product=Product::factory()->create(['user_id'=>$user->id]);
        $comments=Comment::factory(5)->create(['product_id'=>$product->id]);
        $response = $this->get('/comments',[
            'productId'=>$product->id,
            'userId'=>$user->id
        ]);
        $response->assertOk()
                 ->assertExactJson([
                    'comments'=>$comments,
                    'user'=>$user
                 ]);
    }

    public function test_authenticated_user_can_add_comment_on_product()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $product=Product::factory()->create();
        $data=[
          'productId'=>$product->id,
          'userId'=>$user->id,
          'body'=>'nice shoes'
        ];
        $response=$this->post('/comment/store',$data);
        $this->assertDatabaseCount('comments',1);
        $response->assertOk()
                 ->assertJsonFragment(['comment'=>[
                    'user_id'=>$user->id,
                    'product_id'=>$product->id,
                    'body'=>'nice shoes'
                 ]]);
    }

    public function test_authenticated_user_can_update_his_comments()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $comment=Comment::factory()->create([
            'user_id'=>$user->id,
            'body'=>"nice shoes"
        ]);
        $body="nice schoes updated";
        $response=$this->patch('/comment/update',[
            'commentId'=>$comment->id,
            'body'=>$body
        ]);
        $response->assertOk();
        $this->assertEquals($comment->body,$body);
    }

    public function test_authenticated_user_can_delete_his_comments()
    {
        $user=User::factory()->create(['id'=>1]);
        $this->actingAs($user);
        $comment=Comment::factory()->create([
            'user_id'=>$user->id,
            'body'=>"nice shoes"
        ]);
        $response=$this->delete('comment/delete',['commentId'=>$comment->id]);
        $response->assertOk();
        $this->assertDataBaseCount('comments',0);
    }
}
