<?php

namespace NepalFlag;

use Illuminate\Database\Eloquent\Model;

class Users extends Model {

	CONST ACTIVE 	 	= 10;
	CONST INACTIVE 		= 20;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'users';
    
    protected $fillable
    /**
     *
     *
     */

    public static function findAllUsers($active = NULL) {
    	$status = is_null($active) ? Users::ACTIVE : Users::INACTIVE;

    	return Users::where(['status' => 10]) -> orderBy('id', 'desc') -> get();
    }

}
