<?php
namespace CLJAMAL\RaySystem\Controllers;

class AuthController extends CoreController
{
    public function loginPage()
    {
        return view('ray::login');
    }
}
