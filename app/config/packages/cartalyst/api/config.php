<?php
/**
 * Part of the API package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    API
 * @version    1.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011 - 2013, Cartalyst LLC
 * @link       http://cartalyst.com
 */

return array(

	/*
	|--------------------------------------------------------------------------
	| URI Namespace
	|--------------------------------------------------------------------------
	|
	| Not to be confused with PHP namespace, the URI namespace is the URI
	| which the API is located on. This can be configured for security reasons
	| to be something other than the default 'api'.
	|
	| For example:
	|
	|   Api::get('foo/bar/baz');
	|
	| Will route to:
	|
	|  GET /my_secret_api_route/:version/foo/bar/baz
	|
	| When the parameter below is set to a string [my_secret_api].
	|
	| This should ideally be alpha-numeric (and underscores) as it is parsed
	| through Laravel's (and Symfony's) routing structure.
	|
	*/

	'uri_namespace' => 'api',

	/*
	|--------------------------------------------------------------------------
	| Default Version
	|--------------------------------------------------------------------------
	|
	| For convenience, when an internal API request is made, you can skip on
	| the version parameter in the route. If so, we will use the default
	| version specified below.
	|
	| For example:
	|
	|   Api::get('foo/bar/baz');
	|
	| Will route to:
	|
	|  GET /:namespace/v1/foo/bar/baz
	|
	| When the parameter below is set to an integer [1]
	|
	*/

	'default_version' => 1,

	/*
	|--------------------------------------------------------------------------
	| JSON Manipulation
	|--------------------------------------------------------------------------
	|
	| The API allows you to return object instances when dealing with internal
	| requests. However, if you're dealing with external requests we need to
	| convert those objects to JSON. Here you may specify any JSON flags used
	| when casting objects to JSON if you are using our default filters.
	|
	| See http://www.php.net/manual/en/json.constants.php
	|
	| Usage: JSON_FLAG_1|JSON_FLAG_2
	|
	*/

	'json_manipulation' => 0,

);
