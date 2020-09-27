<?php
namespace CLJAMAL\RaySystem;

use Illuminate\Support\Facades\Auth;

class Ray {

    public function guard()
    {
        return Auth::guard( config('ray.auth.guard') );
    }

    public function user()
    {
        return $this->guard()->user();
    }

    public function check()
    {
        return $this->guard()->check();
    }
}
