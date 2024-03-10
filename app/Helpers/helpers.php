<?php

/**
 * Write code on Method
 *
 * @return response()
 */

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


if (!function_exists('areActiveRoutes')) {
    function areActiveRoutes(array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}

if (!function_exists('saveFile')) {
    function saveFile($file, $folderName)
    {
        $path = public_path('uploads/' . $folderName);
        if (!file_exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $origin_name =  $file->getClientOriginalName();
        $extension = pathinfo($origin_name, PATHINFO_EXTENSION);
        $name = Str::random(6) . time() . '.' . $extension;
        $file->move('uploads/' . $folderName, $name);
        return  'uploads/' . $folderName . '/' . $name;
    }
}

if (!function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        return app('url')->asset($path, $secure);
    }
}


if (!function_exists('time_elapsed_string')) {
    function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => trans('messages.year'),
            'm' => trans('messages.month'),
            'w' => trans('messages.week'),
            'd' => trans('messages.day'),
            'h' => trans('messages.hour'),
            'i' => trans('messages.minute'),
            's' => trans('messages.second'),
        );
        $string_sum = array(
            'y' => trans('messages.years'),
            'm' => trans('messages.months'),
            'w' => trans('messages.weeks'),
            'd' => trans('messages.days'),
            'h' => trans('messages.hours'),
            'i' => trans('messages.minutes'),
            's' => trans('messages.seconds'),
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                // $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                if ($diff->$k > 1) {
                    $string[$k] = $diff->$k . ' ' . $string_sum[$k];
                } else {
                    $string[$k] = $diff->$k . ' ' . $string[$k];
                }
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        if (App::getLocale() == 'ar') {
            return $string ? trans('messages. ago') . ' ' . implode(', ', $string)  : trans('messages.just now');
        } else {
            return $string ? implode(', ', $string) . trans('messages. ago') : trans('messages.just now');
        }
    }
}
