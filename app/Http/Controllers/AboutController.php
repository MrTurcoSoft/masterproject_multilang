<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AboutController extends Controller
{
    public function index($locale = null)
    {
        $minutes = 180;

        // Aktif dil kodunu al
        $locale = App::getLocale();

        // Dil koduna uygun şekilde veritabanından veri alma
        $about = Cache::remember("about_key_" . $locale, $minutes, function () {
            return About::firstOrFail();
        });

        $certificate = Cache::remember("certificates_key_" . $locale, $minutes, function () {
            return Certificate::all();
        });

        // Tema seçimine göre uygun görünüme yönlendirme
        $siteTheme = \SiteHelpers::ayar('site_theme');

        switch ($siteTheme) {
            case 1:
                return view('frontend.about', compact('about', 'certificate'));
            case 2:
                return view('porto.about', compact('about', 'certificate'));
            default:
                return view('default.about', compact('about', 'certificate'));
        }
    }
}
