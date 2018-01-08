<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use NepalFlag\Product;

class ProductTest extends DuskTestCase {

    protected $projectPath = '/tproject/demoproject/public/';

    

    public function test_login() {
        $this -> browse(function(Browser $browser) {
            $browser -> visit('/login')
                -> type('email', 'nab11n@yahoo.com')
                -> type('password', 'Kathmandu@11')
                -> press('Login')
                -> assertPathIs($this -> projectPath . "dashboard");
        });
    }



    public function test_product_create() {

        $this -> browse(function(Browser $browser) {
            
            $browser -> visit('/dashboard')
            -> clickLink("Product")
            -> assertPathIs($this -> projectPath . 'product')
            -> clickLink('Add Product')
            -> assertPathIs($this -> projectPath . 'product/create')
            -> type('name', 'Product One')
            -> select('category_id', '1')
            //-> type('category_id', 1)
            -> type('order', '1')
            -> press('Submit')
            -> waitForText('Successfully Added!')
            -> assertSee('Successfully Added!');
        });
    }
    public function test_product_update() {
        
        $this -> browse(function(Browser $browser) {
            $products = Product::all();
            foreach($products as $product) {
                $path = $this -> projectPath . 'product/edit/'. $product -> id;
                $updatePath = 'product/edit/'. $product -> id;

                $newProduct    = $product -> name . '-edited';
                $newDescription = 'Edited:' . $product -> description;

                $browser -> visit('/product')
                    -> click('a[id="edit-'.$product -> id .'"]')
                    -> assertPathIs($path);

                

                $browser -> visit($updatePath)
                    -> type('name', $newProduct)
                    -> type('order', '3')
                    -> press('Submit')
                    -> waitForText('Successfully Updated!')
                    -> assertSee('Successfully Updated!');

                // $browser -> visit('/product')
                //     -> click('a[id="delete-'.$product -> id .'"]')
                //     -> waitForText('Successfully Disabled!')
                //     -> assertSee('Successfully Disabled!')
                //     -> assertPathIs($this -> projectPath . 'product');

            }
        });
    }    
}
