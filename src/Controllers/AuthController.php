<?php
namespace CLJAMAL\RaySystem\Controllers;

use Illuminate\Http\Request;

class AuthController extends CoreController
{
    protected $body_class = 'auth-page';

    public function loginPage()
    {
        return view('ray::' . $this->template . '.login');
    }

    public function postLogin( Request $request ){
        dd($request->all());
    }
}
