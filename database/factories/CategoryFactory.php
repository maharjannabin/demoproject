<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(NepalFlag\Category::class, function (Faker $faker) {
	$category 	= $faker -> word;
    return [
    	'name' 	=> $category,
    	'slug'	=> Str::slug($category),
    	'description'	=> $faker -> paragraph(2),
    	'is_disabled'	=> 10,
      	'created_at'	=> date('Y-m-d H:i:s'),
      	'created_by'	=> 1
    ]; 
});
