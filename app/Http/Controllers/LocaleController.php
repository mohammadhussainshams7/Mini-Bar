<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
class LocaleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $locale = $request->input('locale');
        $available_langs = ['en', 'ar'];

        if (in_array($locale, $available_langs)) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }
        return redirect()->back();

    }
}
