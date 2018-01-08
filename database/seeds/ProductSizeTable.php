<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizeTable extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Db::table('product_size') -> insert([
        	[ 
        		'name' => 'XXL',   	
        		'order'          => 1,
                'is_disabled'    => 10,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
                'created_by'     => 1,
                'updated_by'     => 1
        	],
        	[ 
        		'name' => 'XL',   	
        		'order'          => 1,
                'is_disabled'    => 10,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
                'created_by'     => 1,
                'updated_by'     => 1
        	],
        	[ 
        		'name' => 'L',   	
        		'order'          => 1,
                'is_disabled'    => 10,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
                'created_by'     => 1,
                'updated_by'     => 1
        	],
        	[ 
        		'name' => 'M',   	
        		'order'          => 1,
                'is_disabled'    => 10,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
                'created_by'     => 1,
                'updated_by'     => 1
        	],
        	[ 
        		'name' => 'S',   	
        		'order'          => 1,
                'is_disabled'    => 10,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
                'created_by'     => 1,
                'updated_by'     => 1
        	],
        	[ 
        		'name' => 'XS',   	
        		'order'          => 1,
                'is_disabled'    => 10,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
                'created_by'     => 1,
                'updated_by'     => 1
        	],
        	[ 
        		'name' => 'XYL',   	
        		'order'          => 1,
                'is_disabled'    => 10,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
                'created_by'     => 1,
                'updated_by'     => 1
        	],
        ]);
    }
}
