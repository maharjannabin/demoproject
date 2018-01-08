<?php 

namespace NepalFlag;

class UtilityFunction {


	/**
	 * Generate Slug
	 *
	 * @param $string 
	 */
	public static function generateSlug($string) {
		$string = str_replace(' ', '-', trim($string)); // Replaces all spaces with hyphens.
		return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
	}


}