<?php

namespace NepalFlag;

use Validator;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class ProductOrder extends Model {

	CONST ACTIVE 	= 10;
	CONST INACTIVE  = 20;

	protected $table 	= 'product_order';

	protected $fillable = ['product_id', 'discount', 'service_charge', 'tax', 'quantity', 'sub_total', 'grand_total', 'status', 'note', 'order_by', 'created_at', 'created_by'];

	public static function findOrders($active = NULL) {
	    
	    $status = is_null($active) ? ProductOrder::ACTIVE : ProductOrder::INACTIVE;

		return ProductOrder::where(['status' => $status]) -> orderBy('id', 'desc') -> paginate(10);
    }

	protected $rules 		= [
		'product_id' 	=> 'required|numeric:product_order',
		'product_size' 		=> 'required'
	];

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
     * Product Table 
     * 
     */

    public function productDetail() {
        return $this -> belongsTo('NepalFlag\ProductDetail', 'product_id');
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
            	$model  = ProductDetail::find($input['product_id']);
                $productDetail =  $model -> first();
                if (!is_null($quantity = $productDetail -> quantity)) {
                    $quantity = ($quantity - $input['quantity']);
                    $productDetail -> update(['quantity' => $quantity]);
                }

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
    
}
