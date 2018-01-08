<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(NepalFlag\Product::class, function (Faker $faker) {
	$product 	= $faker -> word;
    return [
      	'name' 	=> $product,
      	'slug'	=> Str::slug($product),
      	'description'	=> $faker -> paragraph(2),
      	'category_id'	=> function() {
      		return factory(NepalFlag\Category::class ) -> create() -> id;
      	},
      	'is_disabled'	=> 10,
      	'created_at'	=> date('Y-m-d H:i:s'),
      	'created_by'	=> 1
    ];
});
