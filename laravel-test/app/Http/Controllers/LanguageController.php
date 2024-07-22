<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;


class LanguageController extends Controller
{
    public function setLocale($lang) {
        if (in_array($lang, ['en', 'vi', 'fr']))
        {
            App::setLocale($lang);
            Session::put('locale', $lang);
        }
        return back();
    }
}
