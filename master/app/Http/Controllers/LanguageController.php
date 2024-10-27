<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function changeLanguage($locale)
    {
        // Ensure the input language is valid
        if (in_array($locale, ['en', 'ar'])) {
            session(['app_locale' => $locale]);
            App::setLocale($locale);
        }

        return redirect()->back();
    }

}
