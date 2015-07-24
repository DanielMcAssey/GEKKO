<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

## API Routes
Route::group(['prefix' => 'api/v1', 'namespace' => 'GEKKO\API\V1'], function() {
	Route::post( 'shorten', array(
		'as' => 'api.shortenURL',
		'uses' => 'LinkController@postShorten'
	) );
});

## User Control Panel Routes
Route::group(['prefix' => 'manage', 'namespace' => 'GEKKO'], function() {
	## Guest Routes
	Route::group(['before' => 'guest'], function()
	{
		## Login Route
		Route::post('login', function() {
			if(Input::has('username') && Input::has('password'))
			{
				$userInput = array(
					'username' => Input::get('username'),
					'password' => Input::get('password')
				);

				if (Auth::attempt($userInput, ((Input::get('rememberme') == 'on') ? true : false)))
				{
					if (Auth::check())
					{
						return Redirect::route('user.index')->with('flash_notice', Lang::get('user.login_success'));
					}
				}
			}

			return Redirect::route('login')->with('flash_error', Lang::get('user.login_failure'))->withInput();
		});

		Route::get('login', array('as' => 'login', function() {
			return View::make('user.login');
		}));
	});

	## Auth Routes
	Route::group(['before' => 'auth'], function() {
		## Auth -> Logout
		Route::get('logout', array('as' => 'logout', function()
		{
			Auth::logout();
			return Redirect::route('login')->with('flash_notice', Lang::get('user.logout_success'));
		}));

		## Auth -> AJAX Routes
		Route::group(['prefix' => 'ajax'], function()
		{
			Route::post( 'user/generateApiKey', array(
				'as' => 'user.newApiKey',
				'uses' => 'UserController@postGenerateNewApiKey'
			) );

			Route::get( 'user/getApiKey', array(
				'as' => 'user.getApiKey',
				'uses' => 'UserController@getApiKey'
			) );

			Route::post( 'user/changePassword', array(
				'as' => 'user.changePassword',
				'uses' => 'UserController@postChangePassword'
			) );

			Route::post( 'user/updateProfile', array(
				'as' => 'user.updateProfile',
				'uses' => 'UserController@postUpdateProfile'
			) );

			Route::post( 'link/shorten', array(
				'as' => 'link.shortenLink',
				'uses' => 'LinkController@postShorten'
			) );

			Route::post( 'link/delete', array(
				'as' => 'link.deleteLink',
				'uses' => 'LinkController@postDelete'
			) );

			Route::post( 'link/getLatest', array(
				'as' => 'link.getLatestLink',
				'uses' => 'LinkController@getLatest'
			) );
		});

		## Auth -> Homepage
		Route::get( '/', array(
			'as' => 'user.index',
			'uses' => 'LinkController@index'
		) );
	});

});

## Admin Routes
Route::group(['prefix' => 'admin', 'namespace' => 'GEKKO\ADMIN', 'before' => 'auth|admin'], function() {
	Route::get( '/', array(
		'as' => 'admin.index',
		'uses' => 'AdminController@index'
	) );
});

Route::get( '/{id}', array(
	'as' => 'index.show',
	'uses' => 'GEKKO\LinkController@show'
) )->where('id', '[a-zA-Z0-9]+');

## Default Route
Route::get('/', function() {
	return View::make('index');
});
