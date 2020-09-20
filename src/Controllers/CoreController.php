<?php
namespace CLJAMAL\RaySystem\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


abstract class CoreController extends Controller{

    protected $template;
    protected $page_name  = null;
    protected $body_class = null;

    public function __construct()
    {
        $this->template  = config('ray.admin.template');

        if ( !empty(request()->route()->getName()) )
            $this->page_name = (string) Str::of( request()->route()->getName() )->replace('.', '--')->kebab();

        view()->share([
            'template' => $this->template,
            'page_name' => $this->page_name,
            'body_class' => $this->body_class,
        ]);
    }
}
