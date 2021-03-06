<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductBrandSeeder::class);
        $this->call(ProductSizeTable::class);
        $this->call(ProductTableSeeder::class);
    }
}
