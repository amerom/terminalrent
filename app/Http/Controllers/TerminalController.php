<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Terminals;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class TerminalController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $v = Validator::make($request->all(), [
            'terminal_id' => 'required',
            'assignament_interval' => 'required',
        ]);

        if($v->fails()) {
            \Session::flash('flash_message_error', 'Requested fields missing');
            return \Redirect::to('users');
        }

        $input = $request->all();
        $date = explode('-', $input['assignament_interval']);
        $date_from = date('Y-m-d H:i', strtotime($date[0]));
        $date_to = date('Y-m-d H:i', strtotime($date[1]));
        $terminal = new Terminals;

        $terminal->terminal_id = $input['terminal_id'];
        $terminal->from = $date_from;
        $terminal->to = $date_to;
        $terminal->user_id = $input['user_id'];
        $terminal->save();

        // sending back with message
        \Session::flash('flash_message_success', 'Terminal successfully assigned');
        return \Redirect::to('users');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
