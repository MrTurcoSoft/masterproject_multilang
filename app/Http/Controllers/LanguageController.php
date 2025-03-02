<?php
// app/Http/Controllers/LanguageController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function changeLanguage($locale)
    {
        // Desteklenen dilleri kontrol edin
        $supportedLocales = ['en', 'de', 'es', 'fr', 'hu', 'it', 'sr'];
        if (in_array($locale, $supportedLocales)) {
            // Oturuma (session) dili kaydedin
            Session::put('locale', $locale);
        }
        return redirect()->back(); // Kullanıcıyı önceki sayfaya yönlendirin
    }
}
