<?php
namespace CLJAMAL\RaySystem\Middleware;

use CLJAMAL\RaySystem\Facades\Ray;
use Illuminate\Support\Str;

class RayMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next )
    {

        $pass = false;
        $uri = $this->currentUri($request->route()->uri);
        if ( $uri && in_array( $uri, $this->except ) )
        {
            $pass = true;
        }
        else
        {
            $pass =  !in_array( $uri, $this->except ) && Ray::check();
        }

        if ( $pass )
            return $next($request);

        return redirect( 'admin/' . config('ray.auth.redirect_to') );
    }

    private function currentUri( $uri ){

        if ( Str::contains( $uri, 'admin/') )
            return Str::replaceFirst('admin/', '', $uri );

        return false;
    }



    private $except = [
        'auth/login'
    ];
}
