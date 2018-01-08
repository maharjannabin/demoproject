<?php

namespace NepalFlag;

use Validator;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;


class ProductSize extends Model {
    

	CONST ACTIVE 	= 10;
	CONST INACTIVE 	= 20;


	public $created_by 	= 1;
	public $update_by  	= 1;

    protected $table 	= 'product_size';

	protected $rules 		= [
		'name' 	=> 'required|unique:product_size',
		'prodcut_size' => 'numeric|required'
	];

	protected $fillable 	= ['name', 'description', 'created_by', 'is_disabled', 'updated_by', 'order'];



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
     * Make Validator Object On Update
     *
     * @param array $attributes
     *
     * @return validator object
     */
	public function validateUpdate($id, $attributes) {
		$this -> update_rules 	= [
			'name' 	=> 'required|unique:product_size,name, ' . $id,
			'order' => 'numeric'
		];

		return Validator::make($attributes, $this -> update_rules);
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
    public static function findSize($active = NULL) {
    	$status = is_null($active) ? ProductSize::ACTIVE:ProductSize::INACTIVE;
    	return ProductSize::where(['is_disabled' => $status]) -> orderBy('order', 'DESC') -> get();
    }

    /**
     *
     * @param boolean $active
     *
     * @return array Cateogries
     */

    public static function dropDownList($active = NULL) {
        $status = is_null($active) ? ProductSize::ACTIVE : ProductSize::INACTIVE;

        return ProductSize::where(['is_disabled' => 10]) -> orderBy('order', 'desc') ->pluck('name', 'id');
    }    
}
