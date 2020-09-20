<?php
namespace CLJAMAL\RaySystem\Controllers;

class AuthController extends CoreController
{
    protected $body_class = 'auth-page';

    public function loginPage()
    {
        return view('ray::' . $this->template . '.login');
    }
}
