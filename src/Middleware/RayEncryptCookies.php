<?php
namespace CLJAMAL\RaySystem\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class RayEncryptCookies extends Middleware
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
