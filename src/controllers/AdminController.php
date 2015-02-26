<?php namespace AbyssalArts\SteamApi\Controllers;

class AdminController extends \Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = \View::make($this->layout);
		}
	}

	protected $layout = 'steam-api::layout';

	public function GetLogin()
	{
		$this->layout->content = \View::make('steam-api::login');
	}

	public function DoLogin()
	{
		// Set authentication config to use 'Steam Admin' instead of 'User'
	    \Config::set('auth.model', 'SteamApi_Admin');
	    $auth = \Auth::createEloquentDriver();
	    \Auth::setProvider($auth->getProvider());

		$input = \Input::all();
		if (\Auth::attempt(array(
			'username' => $input['username'], 
			'password' => $input['password']
			)))
		{
		    return \Redirect::intended('dashboard');
		}
		else
		{
            return \Redirect::route('login')
                ->withInput(\Input::except('password'))
                ->with('error', 'Incorrect username or password.');
		}
	}


}