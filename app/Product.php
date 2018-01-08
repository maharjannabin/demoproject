<?php

namespace NepalFlag;
use Validator;
use Config;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Product extends Model {

	

	// Attributes
    protected $fillable = ['name', 'slug', 'category_id', 'created_by'];

	protected $table 	= 'product';

    protected $rules = [
        'name'  => 'required|max:191|unique:product'
    ];
	
	CONST ACTIVE  	= 10;
	CONST INACTIVE 	= 20;


    /**
     * Category Table 
     * 
     */
    public function category() {
        return $this -> belongsTo('NepalFlag\Category', 'category_id');
    }

    /**
     * Brands Details
     *
     */
    public function brand() {
        return $this -> belongsTo('NepalFlag\Brand', 'brand_id');
    }

    /**
     * Product Table 
     * 
     */

    public function productDetails() {
        return $this -> hasMany('NepalFlag\ProductDetail','product_id');
    }

	/**
     *
     * @param boolean $active
     *
     * @return array Products
     */

    public static function findProducts($active = NULL) {
    	$status = is_null($active) ? Product::ACTIVE : Product::INACTIVE;

    	return Product::where(['status' => 10]) -> orderBy('id', 'desc') -> paginate(Config::get('params.productPagination'));;
    }

    /**
     * Make Validator Object
     *
     * @param $attributes
     *
     * @return validator object
     */

    public function validate($attributes) {
        return Validator::make($attributes, $this -> rules);
    }

    /**
     * Make Validator Object On Update
     *
     * @param array $attributes
     *
     * @return validator object
     */
    public function validateUpdate($id, $attributes) {
        $this -> update_rules   = [
            'name'  => 'required|unique:category,name, ' . $id,
            'order' => 'numeric'
        ];

        return Validator::make($attributes, $this -> update_rules);
    }   

    /**
     * Store 
     *
     * @param $input (attributes with values)
     */
    public function store($input)
    {
        $response       = false;
        $error          = null;

        try {
            DB::transaction(function () use($input, &$response) {
                if(self::create($input)) {
                    $response = true;
                }
            });
        } catch(QueryException $e) {
            $error = $e -> getMessage();
        }

        return ['response' => $response, 'error' => $error];
    }

    /**
     * Update categroy
     *
     * @param array $input (attribute with values)
     *
     * @param integer $id (category id)
     *
     */
    public function change($id, $input) {
        $response       = false;
        $error          = null;

        try {
            DB::transaction(function () use($id, $input, &$response) {
                $response = self::find($id) -> update($input);
            });
        } catch(QueryException $e) {
            $error = $e -> getMessage();
        }

        return ['response' => $response, 'error' => $error];
    }

    /**
     *
     * @param boolean $active
     *
     * @return array Products
     */

    public static function dropDownList($active = NULL) {
        $status = is_null($active) ? Product::ACTIVE : Product::INACTIVE;

        return Product::where(['is_disabled' => $status]) -> orderBy('order', 'desc') ->pluck('name', 'id');
    }
}
