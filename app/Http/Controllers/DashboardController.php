<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index');
    }

    //Tra ve tong so mail den, di, chua doc
    public function get_total(){
        //return view('dashboard.index');
        return response()->json(array('totalInbox' => rand(0, 10000), 'totalOutbox' => rand(0, 10000), 'totalUnsend' => rand(0,10000), 'totalUnread' => rand(0,10000)));

    }
}
