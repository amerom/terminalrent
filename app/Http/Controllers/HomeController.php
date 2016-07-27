<?php namespace App\Http\Controllers;


class HomeController extends Controller {


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(\Auth::check() && !\Auth::user()->is_admin) {
            return \Redirect::to('reports');
        }

        return view('admin.dashboard');
	}

}
