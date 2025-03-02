<header id="header"
        data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyStartAt': 45, 'stickySetTop': '-45px', 'stickyChangeLogo': true}">

    <div class="header-body">
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a href="{{ $locale != $defaultLocale ? url('/'.$locale) : route('home') }}">
                                <img alt="DellaSoft" width="100" height="48" data-sticky-width="82"
                                     data-sticky-height="40" data-sticky-top="25"
                                     src="{{ asset(config('settings.logo')) }}">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row pt-3">
                        <nav class="header-nav-top">
                            <ul class="nav nav-pills">
                                <li class="nav-item nav-item-anim-icon d-none d-md-block">
                                    <a class="nav-link ps-0"
                                       href="{{ $locale != $defaultLocale ? url('/'.$locale.'/'.RouteTranslate_('about')) : route('about') }}">
                                        <i class="fas fa-angle-right"></i> {{___("About Us")}}
                                    </a>
                                </li>
                                <li class="nav-item nav-item-anim-icon d-none d-md-block">
                                    <a class="nav-link"
                                       href="{{ $locale != $defaultLocale ? url('/'.$locale.'/'.RouteTranslate_('contact')) : route('contact') }}">
                                        <i class="fas fa-angle-right"></i> {{___("Contact Us")}}
                                    </a>
                                </li>
                                <li class="nav-item nav-item-left-border nav-item-left-border-remove nav-item-left-border-md-show">
                                    <span class="ws-nowrap"><i class="fas fa-phone"></i> {{config('settings.phoneGsm')}}</span>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="header-row">
                        <div class="header-nav pt-1">
                            <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1">
                                <nav class="collapse">
                                    <ul class="nav nav-pills" id="mainNav">
                                        <li class="menu-item">
                                            <a class="dropdown-item dropdown-toggle @active('home')"
                                               href="{{ $locale != $defaultLocale ? url('/'.$locale) : route('home') }}">
                                                {{___("Home")}}
                                            </a>
                                        </li>
                                        @foreach ($_categories as $category)
                                            @if ($category->altkategoriler->count() > 0)
                                                <li class="dropdown">
                                                    <a class="dropdown-item dropdown-toggle" href="javascript:void(0)">
                                                        {{ strtoupper($category->cat_name) }}
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        @foreach ($category->altkategoriler as $altkategori)
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="{{ $locale != $defaultLocale ? url('/'.$locale.'/'.RouteTranslate_('category').'/'.$altkategori->slug) : route('category', $altkategori->slug) }}">
                                                                    {{ strtoupper($altkategori->cat_name) }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li>
                                                    <a class="menu-item"
                                                       href="{{ $locale != $defaultLocale ? url('/'.$locale.'/'.RouteTranslate_('category').'/'.$category->slug) : route('category', $category->slug) }}">
                                                        {{ strtoupper($category->cat_name) }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                        <li class="menu-item">
                                            <a class="dropdown-item dropdown-toggle"
                                               href="{{ $locale != $defaultLocale ? url('/'.$locale.'/'.RouteTranslate_('catalogue')) : route('catalogue') }}">
                                                {{___("CATALOGUE'S")}}
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a class="dropdown-item dropdown-toggle"
                                               href="{{ $locale != $defaultLocale ? url('/'.$locale.'/'.RouteTranslate_('blog-posts')) : route('blog-posts') }}">
                                                {{___("BLOG")}}
                                            </a>
                                        </li>
                                        @mobile
                                        <li class="menu-item">
                                            <a class="dropdown-item dropdown-toggle"
                                               href="{{ $locale != $defaultLocale ? url('/'.$locale.'/'.RouteTranslate_('about')) : route('about') }}">
                                                {{___("About Us")}}
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a class="dropdown-item dropdown-toggle"
                                               href="{{ $locale != $defaultLocale ? url('/'.$locale.'/'.RouteTranslate_('contact')) : route('contact') }}">
                                                {{___("Contact Us")}}
                                            </a>
                                        </li>
                                        @endmobile
                                    </ul>
                                </nav>
                            </div>
                            <div class="dropdown language-switcher">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="languageDropdown"
            data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('porto/img/flags/' . $locale . '.svg') }}" alt="{{ $locale }}" width="20" height="15"> {{ strtoupper($locale) }}
    </button>
    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
        @foreach (['en' => 'English', 'de' => 'Deutsch', 'es' => 'Español', 'fr' => 'Français', 'hu' => 'Magyar', 'it' => 'Italiano', 'sr' => 'Српски'] as $lang => $language)
            <li>
                <a class="dropdown-item {{ $locale === $lang ? 'active' : '' }}" href="{{ route('changeLanguage', $lang) }}">
                    <img src="{{ asset('porto/img/flags/' . $lang . '.svg') }}" alt="{{ $language }}" width="20" height="15">
                    {{ $language }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
                            <ul class="header-social-icons social-icons d-none d-sm-block">
                                <li class="social-icons-instagram">
                                    <a href="https://www.instagram.com/{{config('settings.instagram')}}" target="_blank"
                                       title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="social-icons-facebook">
                                    <a href="https://www.facebook.com/{{config('settings.facebook')}}" target="_blank"
                                       title="Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="social-icons-linkedin">
                                    <a href="https://www.linkedin.com/showcase/{{config('settings.linkedin')}}"
                                       target="_blank" title="Linkedin">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                            <button class="btn header-btn-collapse-nav" data-bs-toggle="collapse"
                                    data-bs-target=".header-nav-main nav">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
