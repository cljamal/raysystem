<?php
namespace CLJAMAL\RaySystem\Controllers;

use CLJAMAL\RaySystem\Facades\Ray;
use Illuminate\Http\Request;

class AuthController extends CoreController
{
    protected $body_class = 'auth-page';

    public function pageLogin()
    {
        if ( !Ray::check() ){
            return view( $this->template . '.login');
        }
        dd(Ray::user());
    }

    public function postLogin( Request $request ){

        if ( Ray::guard()->attempt(['email' => $request->login, 'password' => $request->password] ))
        {
            return redirect()->back();
        }else{
            dd('No');
        }
    }
}
