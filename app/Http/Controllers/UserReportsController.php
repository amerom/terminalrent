<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Imports;
use Illuminate\Http\Request;

class UserReportsController extends Controller {


    public function __construct() {
        $this->middleware('admin', ['only' => 'index', 'upload']);
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return view('admin.upload');
	}

    /**
     * @return mixedS
     */
    public function upload() {
        // getting all of the post data
        $file = array('file' => \Input::file('file'));
        // setting up rules
        $rules = array('file' => 'required|mimes:txt,csv',);
        // doing the validation, passing post data, rules and the messages
        $validator = \Validator::make($file, $rules);
        $extension = \Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = hash_file('crc32b', \Input::file('file')).'.'.$extension; // renameing file
        $destinationPath = 'uploads'; // upload path
        if (\File::exists($destinationPath . '/'. $fileName)) {
            // sending back with error message.
            \Session::flash('flash_message_error', 'File already exists!');
            return \Redirect::to('upload');
        } elseif ($validator->fails()) {
            // send back to the page with the input data and errors
            return \Redirect::to('upload')->withInput()->withErrors($validator);
        } else {
            // checking file is valid.
            if (\Input::file('file')->isValid()) {
                \Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
                $import = $this->fileImport($destinationPath . '/'. $fileName);

                if($import) {
                    // sending back with message
                    \Session::flash('flash_message_success', 'Upload successfully');
                    return \Redirect::to('upload');
                } else {
                    //if import fails, delete de uploaded file
                    \File::delete($destinationPath . '/'. $fileName);
                    // sending back with error message.
                    \Session::flash('flash_message_error', 'There was a problem with the file import');
                    return \Redirect::to('upload');
                }
            }
            else {
                // sending back with error message.
                \Session::flash('flash_message_error', 'uploaded file is not valid');
                return \Redirect::to('upload');
            }
        }
    }

    /**
     * @param $file
     * @return bool
     */
    private function fileImport($file) {
        set_time_limit(0);
        ini_set('memory_limit', '256M');

        $success = true;
        /*try {
            $import = \Excel::load($file, function($reader) {

            })->toArray();
            foreach ($import as $value) {
                \DB::table('imports') -> insert($value);
            }
        } catch (\Exception $e) {
            $success = false;
        }*/
        try {
            \Excel::filter('chunk')->load($file)->chunk(250, function($results)
            {
                foreach ($results as $value) {
                    \DB::table('imports') -> insert($value->toArray());
                }

            });
        } catch (\Exception $e) {
            $success = false;
        }

        return $success;
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
	public function store()
	{
		//
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
