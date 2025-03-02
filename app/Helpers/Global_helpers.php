<?php


use Illuminate\Support\Facades\File;

if (!function_exists('___')) {
    function ___($key)
    {
        // Geçerli dil ve varsayılan dil tanımlaması
        $locale = app()->getLocale();
        $defaultLocale = 'en';

        // Dil dosyasının yolu (örneğin resources/lang/fr/messages.php)
        $langDirPath = resource_path("lang/{$locale}");
        $langFilePath = "{$langDirPath}/messages.php";
        $defaultLangFilePath = resource_path("lang/{$defaultLocale}/messages.php");

        // Eğer dil klasörü yoksa, yeni bir klasör oluştur
        if (!File::exists($langDirPath)) {
            File::makeDirectory($langDirPath, 0755, true);
        }

        // Eğer dil dosyası yoksa, yeni bir dil dosyası oluştur
        if (!File::exists($langFilePath)) {
            File::put($langFilePath, "<?php\n\nreturn [\n];");
        }

        // Eğer varsayılan dil dosyası yoksa, yeni bir dil dosyası oluştur
        if (!File::exists($defaultLangFilePath)) {
            File::put($defaultLangFilePath, "<?php\n\nreturn [\n];");
        }

        // Dil dosyasını dizi olarak yükle
        $translations = include($langFilePath);
        $defaultTranslations = include($defaultLangFilePath);

        // Eğer çeviri dosyasında anahtar bulunmuyorsa, hem varsayılan hem de mevcut dile ekle
        if (!array_key_exists($key, $defaultTranslations)) {
            $defaultTranslations[$key] = $key;
            $exportedDefaultTranslations = var_export($defaultTranslations, true);
            File::put($defaultLangFilePath, "<?php\n\nreturn {$exportedDefaultTranslations};");
        }

        if (!array_key_exists($key, $translations)) {
            $translations[$key] = $key;
            $exportedTranslations = var_export($translations, true);
            File::put($langFilePath, "<?php\n\nreturn {$exportedTranslations};");
        }

        // Anahtarın çevirisini döndür
        return __('messages.' . $key);
    }
}

//Ürün adresi basitleştirme
if (!function_exists('getProductUrl')) {
    function getProductUrl($product)
    {
        $locale = app()->getLocale();
        $parameters = ['slug' => $product->slug];

        if ($locale !== 'en') {
            $parameters['locale'] = $locale;
        }

        return route('product', $parameters);
    }
}


if (!function_exists('siteAyar')) {
    function siteAyar($str)
    {
        $ayar = config('settings.' . $str);
        return $ayar;

    }
}
if (!function_exists('slugify')) {
    function slugify($str, $options = array())
    {
        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => true
        );
        $options = array_merge($defaults, $options);
        $char_map = array(
            // Latin
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
            'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
            'ß' => 'ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
            'ÿ' => 'y',
            // Latin symbols
            '©' => '(c)',
            // Greek
            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
            'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
            'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
            'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
            'Ϋ' => 'Y',
            'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
            'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
            'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
            'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
            // Turkish
            'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
            'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
            // Russian
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
            'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
            'Я' => 'Ya',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
            'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya',
            // Ukrainian
            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
            'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
            // Czech
            'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
            'Ž' => 'Z',
            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
            'ž' => 'z',
            // Polish
            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
            'Ż' => 'Z',
            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
            'ż' => 'z',
            // Latvian
            'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
            'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
            'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
            'š' => 's', 'ū' => 'u', 'ž' => 'z'
        );
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
        $str = trim($str, $options['delimiter']);
        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }

}
if (!function_exists('__cc')) {
    function __cc($str)
    {
        return config('customservices.' . $str, 'default_value_if_not_found');
    }
}

if (!function_exists('getLocalizedUrl')) {
    function getLocalizedUrl($routeName, $parameters = [])
    {
        $locale = app()->getLocale();

        // Rota için çevirileri al
        $translations = [
            'category' => [
                'en' => 'category',
                'fr' => 'categorie',
                'de' => 'kategorie',
                'it' => 'categoria',
                'hu' => 'kategoriak',
                'sr' => 'kategorija',
                'es' => 'categoria',
            ],
            'product' => [
                'en' => 'product',
                'fr' => 'produit',
                'de' => 'produkt',
                'it' => 'prodotto',
                'hu' => 'termek',
                'sr' => 'proizvod',
                'es' => 'producto',
            ],
            'about' => [
                'en' => 'about',
                'fr' => 'a-propos',
                'de' => 'uber-uns',
                'it' => 'chi-siamo',
                'hu' => 'rolunk',
                'sr' => 'o-nama',
                'es' => 'sobre-nosotros',
            ],
            'contact' => [
                'en' => 'contact',
                'fr' => 'contact',
                'de' => 'kontakt',
                'it' => 'contatto',
                'hu' => 'kapcsolat',
                'sr' => 'kontakt',
                'es' => 'contacto',
            ],
            'catalogue' => [
                'en' => 'catalogue',
                'fr' => 'catalogue',
                'de' => 'katalog',
                'it' => 'catalogo',
                'hu' => 'katalogus',
                'sr' => 'katalog',
                'es' => 'catalogo',
            ],
            'blog-posts' => [
                'en' => 'blog-posts',
                'fr' => 'articles',
                'de' => 'blog-artikel',
                'it' => 'articoli',
                'hu' => 'blog-bejegyzesek',
                'sr' => 'blog-objave',
                'es' => 'entradas-de-blog',
            ],
        ];

        // Parametreleri güncelle
        if (isset($parameters['category']) && isset($translations['category'][$locale])) {
            $parameters['category'] = $translations['category'][$locale];
        }

        if (isset($parameters['product']) && isset($translations['product'][$locale])) {
            $parameters['product'] = $translations['product'][$locale];
        }

        if (isset($parameters['about']) && isset($translations['about'][$locale])) {
            $parameters['about'] = $translations['about'][$locale];
        }
        if (isset($parameters['contact']) && isset($translations['contact'][$locale])) {
            $parameters['contact'] = $translations['contact'][$locale];
        }
        if (isset($parameters['catalogue']) && isset($translations['catalogue'][$locale])) {
            $parameters['catalogue'] = $translations['catalogue'][$locale];
        }
        if (isset($parameters['blog-posts']) && isset($translations['blog-posts'][$locale])) {
            $parameters['blog-posts'] = $translations['blog-posts'][$locale];
        }

        // Varsayılan dil (İngilizce) için dil kodu ekleme
        if ($locale === 'en') {
            return route($routeName, $parameters);
        }

        // Diğer diller için dil kodunu ekle
        $localizedRouteName = 'localized.' . $routeName;
        $parameters = array_merge(['locale' => $locale], $parameters);

        return route($localizedRouteName, $parameters);
    }
}

if (!function_exists('__webp')) {
    /**
     * @throws Exception
     */
    function __webp($image, $folder = 'unknown', $w = 3000, $h = 3000)
    {
        if (!$image || !$image->isValid()) {
            throw new \Exception('Resim dosyası geçersiz.');
        }

        $fileName = time() . '.webp';
        $path = 'storage/images/' . $folder . '/' . $fileName;

        $fullPath = public_path($path);
        $directory = dirname($fullPath);

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (!is_writable($directory)) {
            throw new \Exception("Dizin yazılabilir değil: $directory");
        }

        try {
            \Image::make($image)
                ->encode('webp', 90)
                ->resize($w, $h, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($fullPath);
        } catch (\Exception $e) {
            throw new \Exception("Resim işlenirken hata oluştu: " . $e->getMessage());
        }

        return $path;
    }
}

if (!function_exists('__deleteImage')) {
    function __deleteImage($value, $field = null)
    {
        // Eğer $value bir string ise direkt dosya yolunu al
        if (is_string($value)) {
            $filePath = public_path($value);
        }
        // Eğer $value bir dizi veya nesne ise ilgili alanı al
        elseif (is_array($value) && isset($value[$field])) {
            $filePath = public_path($value[$field]);
        } elseif (is_object($value) && isset($value->$field)) {
            $filePath = public_path($value->$field);
        } else {
            throw new Exception('Geçersiz dosya bilgisi.');
        }

        // Dosya yolunu kontrol et ve sil
        if (!empty($filePath) && file_exists($filePath)) {
            try {
                File::delete($filePath);
                return true; // Başarılı
            } catch (\Exception $e) {
                \Log::error("Dosya silinemedi: " . $e->getMessage());
                return false; // Hata oluştu
            }
        }

        return false; // Dosya bulunamadı
    }
}
if (!function_exists('__deleteFile')) {
    function __deleteFile($value)
    {
        // Dosya yolunu al
        $filePath = public_path($value->file);

        // Dosya yolunun boş olmadığından ve dosyanın var olduğundan emin ol
        if (!empty($value->file) && file_exists($filePath)) {
            try {
                // Dosyayı sil
                File::delete($filePath);
                return true; // Başarılı dönüş
            } catch (\Exception $e) {
                // Hata oluşursa logla veya bir hata mesajı döndür
                \Log::error("Dosya silinemedi: " . $e->getMessage());
                return false; // Hata dönüşü
            }
        }

        return false; // Dosya yok veya boş yol
    }
}

if (!function_exists('RouteTranslate_')) {
    function RouteTranslate_($key)
    {
        $translations = [
            'en' => [
                'about' => 'about',
                'contact' => 'contact',
                'catalogue' => 'catalogue',
                'category' => 'category',
                'product' => 'product',
                'blog-posts' => 'blog-posts',
            ],
            'de' => [
                'about' => 'uber-uns',
                'contact' => 'kontakt',
                'catalogue' => 'katalog',
                'category' => 'kategorie',
                'product' => 'produkt',
                'blog-posts' => 'blog-artikel',
            ],
            'es' => [
                'about' => 'sobre-nosotros',
                'contact' => 'contacto',
                'catalogue' => 'catalogo',
                'category' => 'categoria',
                'product' => 'producto',
                'blog-posts' => 'articulos-del-blog',
            ],
            'fr' => [
                'about' => 'a-propos', // Hakkımızda
                'contact' => 'contact', // İletişim
                'catalogue' => 'catalogue', // Katalog
                'category' => 'categorie', // Kategori
                'product' => 'produit', // Ürün
                'blog-posts' => 'articles-de-blog', // Blog Yazıları
            ],
            'hu' => [
                'about' => 'rolunk',
                'contact' => 'kapcsolat',
                'catalogue' => 'katalogus',
                'category' => 'kategoria',
                'product' => 'termek',
                'blog-posts' => 'blog-cikkek',
            ],
            'it' => [
                'about' => 'chi-siamo',
                'contact' => 'contatto',
                'catalogue' => 'catalogo',
                'category' => 'categoria',
                'product' => 'prodotto',
                'blog-posts' => 'articoli-blog',
            ],
            'sr' => [
                'about' => 'o-nama', // Hakkımızda
                'contact' => 'kontakt', // İletişim
                'catalogue' => 'katalog', // Katalog
                'category' => 'kategorija', // Kategori
                'product' => 'proizvod', // Ürün
                'blog-posts' => 'blog-clanci', // Blog Yazıları
            ],
        ];

        $locale = app()->getLocale();
        return $translations[$locale][$key] ?? $key;
    }
}

if (!function_exists('__Route')) {
    function __Route($key, $parameters = [])
    {
        // Geçerli dil ve varsayılan dil tanımlaması
        $locale = app()->getLocale();
        $defaultLocale = 'en';

        // Mevcut parametrelere locale ekle
        $parameters = array_merge( $parameters);

        // Eğer varsayılan dil değilse, localized rotayı döndür
        if ($locale !== $defaultLocale) {
            return route("{$key}.$locale", $parameters);
        }

        // Varsayılan dil için normal rota
        return route($key, $parameters);
    }
}

if (!function_exists('changeLocaleUrl')) {
    function changeLocaleUrl($locale)
    {
        // Geçerli URL'yi al
        $currentUrl = url()->current();

        // Mevcut dil prefix'ini değiştir
        foreach (['en', 'de', 'es', 'fr', 'hu', 'it', 'sr'] as $lang) {
            if (strpos($currentUrl, "/$lang/") !== false || strpos($currentUrl, "/$lang") !== false) {
                $currentUrl = str_replace("/$lang", "/$locale", $currentUrl);
                break;
            }
        }

        // Eğer dil prefix'i yoksa, başına ekle
        if (!in_array($locale, [ 'de', 'es', 'fr', 'hu', 'it', 'sr'])) {
            return url("/$locale");
        }

        return $currentUrl;
    }
}


if (!function_exists('getRouteTranslations')) {
    function getRouteTranslations() {
        return [
            'en' => [
                'about' => 'about',
                'contact' => 'contact',
                'catalogue' => 'catalogue',
                'category' => 'category',
                'product' => 'product',
                'blog-posts' => 'blog-posts',
            ],
            'de' => [
                'about' => 'uber-uns',
                'contact' => 'kontakt',
                'catalogue' => 'katalog',
                'category' => 'kategorie',
                'product' => 'produkt',
                'blog-posts' => 'blog-artikel',
            ],
            'es' => [
                'about' => 'sobre-nosotros',
                'contact' => 'contacto',
                'catalogue' => 'catalogo',
                'category' => 'categoria',
                'product' => 'producto',
                'blog-posts' => 'articulos-del-blog',
            ],
            'fr' => [
                'about' => 'a-propos', // Hakkımızda
                'contact' => 'contact', // İletişim
                'catalogue' => 'catalogue', // Katalog
                'category' => 'categorie', // Kategori
                'product' => 'produit', // Ürün
                'blog-posts' => 'articles-de-blog', // Blog Yazıları
            ],
            'hu' => [
                'about' => 'rolunk',
                'contact' => 'kapcsolat',
                'catalogue' => 'katalogus',
                'category' => 'kategoria',
                'product' => 'termek',
                'blog-posts' => 'blog-cikkek',
            ],
            'it' => [
                'about' => 'chi-siamo',
                'contact' => 'contatto',
                'catalogue' => 'catalogo',
                'category' => 'categoria',
                'product' => 'prodotto',
                'blog-posts' => 'articoli-blog',
            ],
            'sr' => [
                'about' => 'o-nama', // Hakkımızda
                'contact' => 'kontakt', // İletişim
                'catalogue' => 'katalog', // Katalog
                'category' => 'kategorija', // Kategori
                'product' => 'proizvod', // Ürün
                'blog-posts' => 'blog-clanci', // Blog Yazıları
            ],
        ];
    }
}

if (!function_exists('translateUrlPath')) {
    function translateUrlPath($path, $toLocale) {
        $translations = getRouteTranslations();
        $currentLocale = app()->getLocale();

        // URL parçalarını al
        $segments = explode('/', trim($path, '/'));

        // Her bir segment için çeviri kontrolü
        foreach ($segments as $key => $segment) {
            // Mevcut dilin çevirilerini kontrol et
            foreach ($translations[$currentLocale] ?? [] as $routeKey => $routeValue) {
                if ($segment === $routeValue) {
                    // Hedef dildeki karşılığını bul
                    $segments[$key] = $translations[$toLocale][$routeKey] ?? $segment;
                    break;
                }
            }
        }

        return implode('/', $segments);
    }
}



if (!function_exists('localizedRoute')) {
    function localizedRoute($name, $locale = null) {
        $locale = $locale ?: app()->getLocale();
        $translations = getRouteTranslations();

        // Varsayılan dil için normal route'u kullan
        if ($locale === config('app.fallback_locale')) {
            return route($name);
        }

        // Diğer diller için dil ekli route'u kullan
        return route($name . '.' . $locale);
    }
}


// app/Helpers/RouteTranslations.php

if (!function_exists('getSlugTranslations')) {
    function getSlugTranslations($model, $currentSlug)
    {
        $locales = ['en', 'de', 'es', 'fr', 'hu', 'it', 'sr'];
        $translations = [];

        // Tüm diller için slug'ları al
        foreach ($locales as $locale) {
            $slugField = 'slug_' . $locale;
            if (isset($model->$slugField)) {
                $translations[$locale] = $model->$slugField;
            }
        }

        return $translations;
    }
}


if (!function_exists('getSlugTranslations')) {
    function getSlugTranslations($model, $currentLocale, $targetLocale) {
        $defaultLocale = config('app.fallback_locale', 'en');

        // Mevcut slug'ı al
        $currentSlug = $currentLocale === $defaultLocale
            ? $model->slug  // Varsayılan dil için normal slug
            : $model->{'slug_' . $currentLocale}; // Diğer diller için dile özgü slug

        // Hedef slug'ı al
        $targetSlug = $targetLocale === $defaultLocale
            ? $model->slug  // Varsayılan dil için normal slug
            : $model->{'slug_' . $targetLocale}; // Diğer diller için dile özgü slug

        return [
            'current' => $currentSlug,
            'target' => $targetSlug
        ];
    }
}

if (!function_exists('translateUrlSegments')) {
    function translateUrlSegments($path, $fromLocale, $toLocale) {
        $defaultLocale = config('app.fallback_locale', 'en');

        // Statik rota çevirileri
        $staticRoutes = [
            'en' => [
                'about' => 'about',
                'contact' => 'contact',
                'catalogue' => 'catalogue',
                'category' => 'category',
                'product' => 'product',
                'blog-posts' => 'blog-posts',
            ],
            'de' => [
                'about' => 'uber-uns',
                'contact' => 'kontakt',
                'catalogue' => 'katalog',
                'category' => 'kategorie',
                'product' => 'produkt',
                'blog-posts' => 'blog-artikel',
            ],
            'es' => [
                'about' => 'sobre-nosotros',
                'contact' => 'contacto',
                'catalogue' => 'catalogo',
                'category' => 'categoria',
                'product' => 'producto',
                'blog-posts' => 'articulos-del-blog',
            ],
            'fr' => [
                'about' => 'a-propos', // Hakkımızda
                'contact' => 'contact', // İletişim
                'catalogue' => 'catalogue', // Katalog
                'category' => 'categorie', // Kategori
                'product' => 'produit', // Ürün
                'blog-posts' => 'articles-de-blog', // Blog Yazıları
            ],
            'hu' => [
                'about' => 'rolunk',
                'contact' => 'kapcsolat',
                'catalogue' => 'katalogus',
                'category' => 'kategoria',
                'product' => 'termek',
                'blog-posts' => 'blog-cikkek',
            ],
            'it' => [
                'about' => 'chi-siamo',
                'contact' => 'contatto',
                'catalogue' => 'catalogo',
                'category' => 'categoria',
                'product' => 'prodotto',
                'blog-posts' => 'articoli-blog',
            ],
            'sr' => [
                'about' => 'o-nama', // Hakkımızda
                'contact' => 'kontakt', // İletişim
                'catalogue' => 'katalog', // Katalog
                'category' => 'kategorija', // Kategori
                'product' => 'proizvod', // Ürün
                'blog-posts' => 'blog-clanci', // Blog Yazıları
            ]
        ];

        $segments = explode('/', trim($path, '/'));
        $newSegments = [];

        // İlk segment dil kodu ise ve varsayılan dile geçiliyorsa, onu atla
        if (count($segments) > 0 && $segments[0] === $fromLocale && $toLocale === $defaultLocale) {
            array_shift($segments);
        }

        foreach ($segments as $segment) {
            // Önce statik rotalarda ara
            if (isset($staticRoutes[$fromLocale])) {
                $key = array_search($segment, $staticRoutes[$fromLocale]);
                if ($key !== false && isset($staticRoutes[$toLocale][$key])) {
                    $newSegments[] = $staticRoutes[$toLocale][$key];
                    continue;
                }
            }

            // Statik rotada bulunamadıysa, veritabanında ara
            try {
                // Kategori slug'ı olabilir
                $category = \App\Models\Category::where(function($query) use ($segment, $fromLocale, $defaultLocale) {
                    if ($fromLocale === $defaultLocale) {
                        $query->where('slug', $segment);
                    } else {
                        $query->where('slug_' . $fromLocale, $segment);
                    }
                })->first();

                if ($category) {
                    $newSegments[] = $toLocale === $defaultLocale
                        ? $category->slug
                        : $category->{'slug_' . $toLocale};
                    continue;
                }

                // Bulunamadıysa segment'i olduğu gibi kullan
                $newSegments[] = $segment;

            } catch (\Exception $e) {
                // Hata durumunda segment'i olduğu gibi kullan
                $newSegments[] = $segment;
            }
        }

        // Eğer hedef dil varsayılan dil değilse ve ilk segment dil kodu değilse, dil kodunu ekle
        if ($toLocale !== $defaultLocale && (!count($newSegments) || $newSegments[0] !== $toLocale)) {
            array_unshift($newSegments, $toLocale);
        }

        return implode('/', $newSegments);
    }
}
