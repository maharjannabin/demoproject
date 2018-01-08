<?php

namespace Tests\Unit;

use Rules;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use NepalFlag\Product;
class ProductTest extends TestCase
{

	use RefreshDatabase;
    // /**
    //  * A basic test example.
    //  *
    //  * @return void
    //  */
    // public function testProductCreate() {
    	
    //     $input = [
    //         'name'  => 'Camera1',
    //         'slug'  => 'camera1',
    //         'category_id' => 1,
    //         'description' => 'this is a test descripton',
    //         'status'       => 10,
    //         'is_disabled'   => 10,
    //         'brand_id'      => 1,
    //         'created_at'    => date('Y-m-d H:i:s'),
    //         'created_by'    => 1
    //     ];

    //     $model = new Product;
    //     $store = $model -> store($input);

    //     $this -> assertEquals(true, $store['response']);
    	
    // }

    public function test_registration() {
        $this   -> visit('/register')
                -> type('nab11n@yahoo.com', 'username')
                -> type('Nabin', 'first_name')
                -> type('Maharjan', 'last_name')
                -> type('nab11n@yahoo.com', 'email')
                -> type('9851003234', 'phone')
                -> type('Kathmandu@11', 'password')
                -> type('Kathmandu@11', 'password_confirmation')
                -> press('Register')
                -> seePageIs('/dashboard');
    }

}
