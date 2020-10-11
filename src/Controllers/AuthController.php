<?php
namespace CLJAMAL\RaySystem\Controllers;

use CLJAMAL\RaySystem\Facades\Ray;
use Illuminate\Http\Request;
use CLJAMAL\RaySystem\Classes\Form;

class AuthController extends CoreController
{
    protected $body_class = 'auth-page';

    public function pageLogin()
    {
        $form = new Form();

        dd('test');

        if ( !Ray::check() ){
            return view( $this->template . 'login');
        }
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
