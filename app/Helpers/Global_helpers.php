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
        if (app()->getLocale() !== 'en') {
            return route('product', ['locale' => app()->getLocale(), 'slug' => $product->slug]);
        }
        return route('product', ['slug' => $product->slug]);
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



