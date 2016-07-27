<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Imports;

class ReportsController extends Controller {

    public function __construct() {
        $this->middleware('auth');

        if(\Auth::check()) {
            $this->userId = \Auth::user()->id;
            $this->isAdmin = false;

            if(\Auth::user()->is_admin) {
                $this->userId = \Route::current()->getParameter('id');
                $this->isAdmin = true;
            }
        }

    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $imports = new Imports();
        $reports = $imports->generateReports($this->userId, $this->isAdmin);
        $summary = $imports->generateSummary($this->userId, $this->isAdmin);
        $total = $imports->generateTotal($this->userId, $this->isAdmin);

        $data = ['reports' => $reports, 'summary' => $summary, 'total' => $total];
        return view('admin.reports', $data);
	}

}
