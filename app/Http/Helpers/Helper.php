<?php
namespace App\Helpers;
use App\Helpers;
use Illuminate\Support\Facades\Request;

class Helper  {
    function activeMenu($uri = '') {
        $active = '';
        if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
            $active = 'active';
        }
        return $active;
    }
    if (! function_exists('show_route')) {
        function show_route($model, $resource = null)
        {
            $resource = $resource ?? plural_from_model($model);
    
            return route("{$resource}.show", $model);
        }
    }
    
    if (! function_exists('plural_from_model')) {
        function plural_from_model($model)
        {
            $plural = Str::plural(class_basename($model));
    
            return Str::kebab($plural);
        }
    }
}
    