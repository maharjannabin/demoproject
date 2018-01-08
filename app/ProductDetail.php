<?php

namespace NepalFlag;

use Validator;
use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;


class ProductDetail extends Model {
    

	CONST ACTIVE 	= 10;
	CONST INACTIVE 	= 20;


	public $created_by 	= 1;
	public $update_by  	= 1;

    protected $table 	= 'product_detail';

	protected $rules 		= [
		'size_id' 	=> 'numeric:product_detail',
		'quantity' 	=> 'numeric',
		'order' 	=> 'numeric',
		'product_id'=> 'numeric'
	];

	protected $fillable 	= ['size_id', 'quantity', 'price', 'description', 'is_disabled', 'order', 'product_id', 'created_by', 'updated_by'];
    /**
     * Make Validator Object
     *
     * @param array $attributes
     *
     * @return validator object
     */
	public function validate($attributes) {
		return Validator::make($attributes, $this -> rules);
	}



    /**
     * Product Table 
     * 
     */

    public function product() {
        return $this -> belongsTo('NepalFlag\Product', 'product_id');
    }

    /**
     * Belongs To realtionship with Product Size
     */
    public function size() {
        return $this -> belongsTo('NepalFlag\ProductSize', 'size_id');
    }


    /**
     * Make Validator Object On Update
     *
     * @param array $attributes
     *
     * @return validator object
     */
	public function validateUpdate($id, $attributes) {
		$this -> update_rules 	= [
					'size_id' 	=> 'numeric:product_detail, name, ' . $id,
					'quantity' 	=> 'numeric',
					'order' 	=> 'numeric',
					'product_id'=> 'numeric'
		];

		return Validator::make($attributes, $this -> rules);
	}	


    /**
     * Insert category 
     *
     * @param array $input (attributes with values)
     */
    public function store($input) {
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
     * Find all Brands (active|inactive)
     *
     * @param boolean $active (NULL\ TRUE)
     * 
     * @return array Active/Incative Brands
     */
    public static function findProductDetails($active = NULL) {
    	$status = is_null($active) ? ProductDetail::ACTIVE:ProductDetail::INACTIVE;
    	return ProductDetail::where(['is_disabled' => $status]) -> orderBy('order', 'DESC') -> paginate(Config::get('params.prodcutDetails'));
    }
    
    public static function findProductDetail($id, $size) {
        return ProductDetail::where(['product_id' => $id, 'size_id' => $size]) -> first();
    }
}
