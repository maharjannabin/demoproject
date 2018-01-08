<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use NepalFlag\Category;

class CategoryTest extends DuskTestCase
{

    use RefreshDatabase;

    protected $projectPath = '/tproject/demoproject/public/';

    public function test_registration() {
        $this->browse(function (Browser $browser) {
            $browser   -> visit('/register')
                    -> type('username', 'nab11n@yahoo.com' )
                    -> type('first_name', 'Nabin')
                    -> type('last_name', 'Maharjan')
                    -> type('email', 'nab11n@yahoo.com')
                    -> type('phone', '9851003234')
                    -> type('password', 'Kathmandu@11')
                    -> type('password_confirmation', 'Kathmandu@11' )
                    -> press('Register')
                    -> assertPathIs($this -> projectPath ."dashboard");    

        });
    }


    public function test_login() {
        $this -> browse(function(Browser $browser) {
            $browser -> visit('/dashboard') 
                     -> clickLink('Logout') 
                     -> assertPathIs($this -> projectPath);

            $browser -> visit('/login')
                -> type('email', 'nab11n@yahoo.com')
                -> type('password', 'Kathmandu@11')
                -> press('Login')
                -> assertPathIs($this -> projectPath . "dashboard");
        });
    }

    public function test_category_create() {

        $this -> browse(function(Browser $browser) {
            $browser -> visit('/dashboard')
            -> clickLink('Category')
            -> assertPathIs($this -> projectPath . 'category')
            -> clickLink('Add Category')
            -> assertPathIs($this -> projectPath . 'category/create')
            -> type('name', 'Electronics')
            -> type('order', '1')
            -> type('description', 'This is a test description')
            -> press('Submit')
            -> waitForText('Successfully Added!')
            -> assertSee('Successfully Added!');
        });
    }

    public function test_category_update() {
        
        $this -> browse(function(Browser $browser) {
            $categories = Category::all();
            foreach($categories as $category) {
                $path = $this -> projectPath . 'category/edit/'. $category -> id;
                $updatePath = 'category/edit/'. $category -> id;

                $newCategory    = $category -> name . '-edited';
                $newDescription = 'Edited:' . $category -> description;

                $browser -> visit('/category')
                    -> click('a[id="edit-'.$category -> id .'"]')
                    -> assertPathIs($path);

                

                $browser -> visit($updatePath)
                    -> type('name', $newCategory)
                    -> type('description', $newDescription)
                    -> type('order', '3')
                    -> press('Submit')
                    -> waitForText('Successfully Updated!')
                    -> assertSee('Successfully Updated!');

                // $browser -> visit('/category')
                //     -> click('a[id="delete-'.$category -> id .'"]')
                //     -> waitForText('Successfully Disabled!')
                //     -> assertSee('Successfully Disabled!')
                //     -> assertPathIs($this -> projectPath . 'category');

            }
        });
    }




}
