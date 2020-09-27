<?php
namespace CLJAMAL\RaySystem\Middleware;

use Illuminate\Routing\Middleware\SubstituteBindings as Middleware;

class RaySubstituteBindings extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];

}
