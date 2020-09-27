<?php

namespace CLJAMAL\RaySystem\Facades;

use Illuminate\Support\Facades\Facade;
use CLJAMAL\RaySystem\Ray as RayBase;

/**
 * Class Ray
 * @method static \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard guard()
 * @method bool check()
 * @package CLJAMAL\RaySystem\Facades
 */


class Ray extends Facade{

    protected static function getFacadeAccessor()
    {
        return RayBase::class;
    }
}
