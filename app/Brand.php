<?php

namespace NepalFlag;

use Validator;
use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;


class Brand extends Model {
    

	CONST ACTIVE 	= 10;
	CONST INACTIVE 	= 20;


	public $created_by 	= 1;
	public $update_by  	= 1;

    protected $table 	= 'product_brand';

	protected $rules 		= [
		'name' 	=> 'required|unique:product_brand',
		'order' => 'numeric'
	];

	protected $fillable 	= ['name', 'slug', 'description', 'created_by', 'logo', 'order'];
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
			'name' 	=> 'required|unique:product_brand,name, ' . $id,
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
    public static function findBrands($active = NULL) {
    	$status = is_null($active) ? Brand::ACTIVE:Brand::INACTIVE;
    	return Brand::where(['is_disabled' => $status]) -> orderBy('order', 'DESC') -> paginate(Config::get('params.brandPagination'));
    }

    /**
     *
     * @param boolean $active
     *
     * @return array Brand
     */

    public static function dropDownList($active = NULL) {
        $status = is_null($active) ? Brand::ACTIVE : Brand::INACTIVE;

        return Brand::where(['is_disabled' => 10]) -> orderBy('order', 'desc') ->pluck('name', 'id');
    }           
}
