<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * The URIs that should be excluded from CSRF verification.
	 *
	 * @var array
	 */
	protected $except = [
		"cpanel/cars/saveCroppedImage",
		"uploadNewImages",
		"uploadImages",
		"payment_success",
		"car/reserve",
		"cpanel/price/defaultrule",
		'car/reserve/userDetails',
		'cpanel/cars/bulkAddListings_alias',
	];
}