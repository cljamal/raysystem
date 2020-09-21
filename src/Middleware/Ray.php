<?php
namespace CLJAMAL\RaySystem\Middleware;


class Ray
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, \Closure $next, $guard = null)
    {
        $path = '/'.trim(config('ray.routes.admin-prefix'), '/');

        config(['session.path' => $path]);

        if ($domain = config('ray.routes.domain')) {
            config(['session.domain' => $domain]);
        }

        return $next($request);
    }
}
