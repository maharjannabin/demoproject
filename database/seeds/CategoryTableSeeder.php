<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoryTableSeeder extends Seeder
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
                'name'           => 'Category '. $range,
                'slug'           => $this -> generateSlug('Category '. $range),
                'description'    =>  'The query builder also provides convenient methods for incrementing or decrementing the value of a given column.',
                'order'          => 1,
                'is_disabled'    => 10,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
                'created_by'     => 1,
                'updated_by'     => 1
            ];
        }


        DB::table('category')->insert($array);
    }

    public function generateSlug($string) {
        $string = str_replace(' ', '-', trim($string)); // Replaces all spaces with hyphens.
        return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
    }
}