{{-- resources/views/components/language-switcher.blade.php --}}

@php
    $currentLocale = app()->getLocale();
    $languages = [
        'en' => 'English',
        'de' => 'Deutsch',
        'es' => 'Español',
        'fr' => 'Français',
        'hu' => 'Magyar',
        'it' => 'Italiano',
        'sr' => 'Српски'
    ];
@endphp

<div class="dropdown language-switcher">
    {{-- dropdown-toggle sınıfını kaldırdık --}}
    <button class="btn" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('porto/img/flags/' . $currentLocale . '.svg') }}" alt="{{ $languages[$currentLocale] }}" width="20" height="15">
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
        @foreach ($languages as $locale => $language)
            @if($locale !== $currentLocale)
                <li>
                    <a class="dropdown-item" href="{{ route('changeLanguage', $locale) }}">
                        <img src="{{ asset('porto/img/flags/' . $locale . '.svg') }}" alt="{{ $language }}" width="20" height="15">
                        <span>{{ $language }}</span>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>

@push('styles')
<style>
    .language-switcher {
        position: relative;
        display: inline-block;
    }

    .language-switcher .btn {
        border: none;
        background-color: transparent;
        padding: 8px;
        display: flex;
        align-items: center;
        color: #333;
        font-weight: 500;
    }

    /* Tüm olası ok işaretlerini kaldır */
    .language-switcher .btn::after,
    .language-switcher .btn::before {
        display: none !important;
        content: none !important;
    }

    .language-switcher .btn:hover,
    .language-switcher .btn:focus {
        background-color: transparent;
        color: #333;
        box-shadow: none;
    }

    .language-switcher .dropdown-menu {
        min-width: 180px;
        padding: 0.5rem 0;
        margin-top: 8px;
        border-radius: 4px;
        border: 1px solid rgba(0,0,0,0.1);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .language-switcher .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 16px;
        color: #333;
        transition: background-color 0.2s;
    }

    .language-switcher .dropdown-item:hover {
        background-color: #f8f9fa;
    }

    .language-switcher img {
        border-radius: 2px;
        object-fit: cover;
    }

    /* Global olarak dropdown okunu kaldır */
    .dropdown-toggle::after {
        display: none !important;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl);
        });
    });
</script>
@endpush
