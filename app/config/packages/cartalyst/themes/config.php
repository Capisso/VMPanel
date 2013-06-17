<?php
/**
 * Part of the Themes package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    Themes
 * @version    2.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011 - 2013, Cartalyst LLC
 * @link       http://cartalyst.com
 */

return array(

	/*
	|--------------------------------------------------------------------------
	| Active Theme
	|--------------------------------------------------------------------------
	|
	| Here you can specify the default active theme for your application, or
	| set to null if none is defined.
	|
	*/

	'active' => 'capisso_default',

	/*
	|--------------------------------------------------------------------------
	| Fallback Theme
	|--------------------------------------------------------------------------
	|
	| Here you can specify the default fallback theme for your application, or
	| set to null if none is defined.
	|
	*/

	'fallback' => null,

	/*
	|--------------------------------------------------------------------------
	| Theme Paths
	|--------------------------------------------------------------------------
	|
	| Here you set the default theme paths for your application. Paths should
	| also be set relative to a publically accessible directory so assets can
	| be resolved.
	|
	*/

	'paths' => array(
		__DIR__.'/../../../../../public/themes',
	),

	/*
	|--------------------------------------------------------------------------
	| Packages Path
	|--------------------------------------------------------------------------
	|
	| Here, you set the path (relative to your theme's root folder) for all
	| packages to reside.
	|
	*/

	'packages_path' => 'packages',

	/*
	|--------------------------------------------------------------------------
	| Namespaces Path
	|--------------------------------------------------------------------------
	|
	| We even let you theme up Laravel 4 view namespaces. You can register a
	| namespace for a view, for example:
	|
	|	View::addNamespace('foo/bar', '/var/www/some/namespace');
	|
	| This means that, when you call:
	|
	|	View::make('foo/bar::test');
	|
	| It will look in the namespace you specified. However, you can also call
	| Theme::namespace('foo/bar'); which means that all calls to the 'foo/bar'
	| namespace will first check for that namespace within your theme first,
	| before falling back to the hard-coded namespace. Yes, you can theme any
	| view in Laravel now!
	|
	*/

	'namespaces_path' => 'namespaces',

	/*
	|--------------------------------------------------------------------------
	| Views Path
	|--------------------------------------------------------------------------
	|
	| List the path (within each theme and it's packages) where views are
	| located.
	|
	*/

	'views_path' => 'views',

	/*
	|--------------------------------------------------------------------------
	| Assets Path
	|--------------------------------------------------------------------------
	|
	| List the path (within each theme and it's packages) where assets are
	| located.
	|
	*/

	'assets_path' => 'assets',

	/*
	|--------------------------------------------------------------------------
	| Assets Cache Path
	|--------------------------------------------------------------------------
	|
	| The path (relative to your public path) where assets are cached upon
	| compilation.
	|
	*/

	'cache_path' => 'assets/cache',

	/*
	|--------------------------------------------------------------------------
	| Asset Default Filters
	|--------------------------------------------------------------------------
	|
	| List the filters used when compiling assets. Filters may be a string
	| representation of the class or a closure which returns a new instance
	| of a filter.
	|
	| Filters are provided through Assetic, which does not supply all the
	| libraries required to make the filters work. Some libraries must be
	| installed to your local machine. For example, the CoffeScriptFilter
	| requires that the `coffee` command-line app is installed on your
	| machine.
	|
	*/

	'filters' => array(

		'css' => array(

			'Assetic\Filter\CssImportFilter',
			'Basset\Filter\UriRewriteFilter',

		),

		'less' => array(

			'Assetic\Filter\LessphpFilter',
			'Basset\Filter\UriRewriteFilter',

		),

		'sass' => array(

			'Cartalyst\AsseticFilters\SassphpFilter',
			'Basset\Filter\UriRewriteFilter',

		),

		'scss' => array(

			'Assetic\Filter\ScssphpFilter',
			'Basset\Filter\UriRewriteFilter',

		),

		'js' => array(

			'Assetic\Filter\JSMinFilter',

		),

		'coffee' => array(

			'Cartalyst\AsseticFilters\CoffeeScriptphpFilter',
			'Assetic\Filter\JSMinFilter',

		),

	),

	/*
	|--------------------------------------------------------------------------
	| Debug Mode
	|--------------------------------------------------------------------------
	|
	| You can specify if you want to force this package to run in debug mode.
	| Debug mode will change the way assets are compiled.
	|
	| By default, we guess whether you are in a production environment or not,
	| and if you're not in production we will assume you're in debug mode. YOu
	| can explicitly set this however below.
	|
	| Supported: null, true, false (where null is "automatic detection").
	|
	*/

	'debug' => null,

);
