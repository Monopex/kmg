<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\Borehols;

class ApiController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function lists (Request $request)
    {
        return Borehols::get_lists($request);
    }

    public function filter (Request $request)
    {
        return Borehols::filter($request);
    }
    
    public function remove_borehole (Request $request)
    {
        return Borehols::remove($request);
    }

    public function save_borehole (Request $request)
    {
        return Borehols::save($request);
    }

    public function chars ()
    {
        return Borehols::chars();
    }
}
