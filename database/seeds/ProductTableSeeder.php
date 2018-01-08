<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $array = [];
        foreach (range(1, 50) as $range) {

            $array[] = [
                'name'           => 'Product '. $range,
                'slug'           => $this -> generateSlug('Product '. $range),
                'description'    =>  'The query builder also provides convenient methods for incrementing or decrementing the value of a given column.',
                'category_id' 		 => $range,
                'order'          => $range,
                'is_disabled'    => 10,
                'weight' 		=> $range,
                'brand_id'		 => $range,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
                'created_by'     => 1,
                'updated_by'     => 1
            ];
        }


        DB::table('product')->insert($array);
    }

    public function generateSlug($string) {
        $string = str_replace(' ', '-', trim($string)); // Replaces all spaces with hyphens.
        return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
    }
}
