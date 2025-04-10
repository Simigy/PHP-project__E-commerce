<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        if (array_key_exists($lang, config('languages.supported'))) {
            session()->put('locale', $lang);
            App::setLocale($lang);
        }
        return redirect()->back()->with('success', __('message.language_changed'));
    }
}
