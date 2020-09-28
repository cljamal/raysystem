<?php
namespace CLJAMAL\RaySystem\Controllers;

use Illuminate\Http\Request;

class DashController extends CoreController
{
    protected $body_class = 'dash-page';

    public function index()
    {
        return view( $this->template . '.dashboard' );
    }

    public function postLogin( Request $request ){
        dd($request->all());
    }
}
