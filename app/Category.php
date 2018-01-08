<?php

namespace NepalFlag;

use Validator;
use Config;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Category extends Model {


	CONST ACTIVE  	= 10;
	CONST INACTIVE 	= 20;
	protected $table 	= 'category';

	public $created_by 	= 1;
	public $update_by  	= 1;
	
	protected $fillable 	= ['name', 'slug', 'description', 'category_id', 'is_disabled', 'order', 'created_by'];

	protected $rules 		= [
		'name' 	=> 'required|unique:category',
		'order' => 'numeric'
	];

	
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
			'name' 	=> 'required|unique:category,name, ' . $id,
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
     *
     * @param boolean $active (null|true)
     *
     * @return array Products
     */

    public static function findCategories($active = NULL) {
    	$status = is_null($active) ? Category::ACTIVE : Category::INACTIVE;

    	return Category::where(['is_disabled' => $status]) -> orderBy('id', 'desc') -> paginate(Config::get('params.categoryPagination'));
    }	

	/**
     *
     * @param boolean $active
     *
     * @return array Cateogries
     */

    public static function dropDownList($active = NULL) {
    	$status = is_null($active) ? Category::ACTIVE : Category::INACTIVE;

    	return Category::where(['is_disabled' => 10]) -> orderBy('order', 'desc') ->pluck('name', 'id');
    }	    
    
}
