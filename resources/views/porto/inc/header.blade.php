<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyStartAt': 45, 'stickySetTop': '-45px', 'stickyChangeLogo': true}">
    <div class="header-body">
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a href="{{ app()->getLocale() === config('app.locale') ? route('home') : route('localized.home', ['locale' => app()->getLocale()]) }}">
                                <img alt="DellaSoft" width="100" height="48" data-sticky-width="82" data-sticky-height="40" data-sticky-top="25" src="{{ asset(config('settings.logo')) }}">
                            </a>

                        </div>
                    </div>
                </div>

                <div class="header-column justify-content-end">
                    <div class="header-row pt-3">
                        <nav class="header-nav-top">
                            <ul class="nav nav-pills">
                                <li class="nav-item nav-item-anim-icon d-none d-md-block">
                                    <a class="nav-link ps-0" href="{{ app()->getLocale() === config('app.locale') ? route('about') : route('localized.about', ['locale' => app()->getLocale()]) }}"><i class="fas fa-angle-right"></i> {{___("About Us")}}</a>

                                </li>
                                <li class="nav-item nav-item-anim-icon d-none d-md-block">
                                    <a class="nav-link" href="{{ app()->getLocale() === config('app.locale') ? route('contact') : route('localized.contact', ['locale' => app()->getLocale()]) }}"><i class="fas fa-angle-right"></i> {{___("Contact Us")}}</a>

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
                                        <li class="menu-item ">
                                            <a class="dropdown-item dropdown-toggle @active('home')" href="{{ app()->getLocale() === config('app.locale') ? route('home') : route('localized.home', ['locale' => app()->getLocale()]) }}">
                                                {{___("Home")}}
                                            </a>

                                        </li>
                                        @foreach ($_categories as $category)
                                            @if ($category->altkategoriler->count() > 0) {{-- Eğer alt kategoriler varsa --}}
                                            <li class="dropdown">
                                                <!-- Ana Kategori İsmi -->
                                                <a class="dropdown-item dropdown-toggle" href="javascript:void(0)">
                                                    {{ strtoupper($category->cat_name) }}
                                                </a>
                                                <!-- Alt Kategoriler -->
                                                <ul class="dropdown-menu">
                                                    @foreach ($category->altkategoriler as $altkategori)

                                                        <li>
                                                            <a class="dropdown-item" href="{{ app()->getLocale() === config('app.locale') ? route('category', ['slug' => $altkategori->slug]) : route('localized.category', ['slug' => $altkategori->slug]) }}">
                                                                {{ strtoupper($altkategori->cat_name) }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @else {{-- Eğer alt kategorisi yoksa --}}
                                            <li>
                                                <a class="menu-item" href="{{ app()->getLocale() === config('app.locale') ? route('category', ['slug' => $category->slug]) : route('localized.category', ['slug' => $category->slug]) }}">
                                                    {{ strtoupper($category->cat_name) }}
                                                </a>
                                            </li>
                                            @endif
                                        @endforeach


                                        <li class="menu-item">
                                            <a class="dropdown-item dropdown-toggle" href="{{ app()->getLocale() === config('app.locale') ? route('catalogue') : route('localized.catalogue', ['locale' => app()->getLocale()]) }}">
                                                {{___("CATALOGUE’S")}}
                                            </a>

                                        </li>
                                        <li class="menu-item">
                                            <a class="dropdown-item dropdown-toggle" href="{{ app()->getLocale() === config('app.locale') ? route('blog-posts') : route('localized.blog-posts', ['locale' => app()->getLocale()]) }}">
                                                {{___("BLOG")}}
                                            </a>

                                        </li>
                                        @mobile
                                        <li class="menu-item">
                                            <a class="dropdown-item dropdown-toggle" href="{{ app()->getLocale() === config('app.locale') ? route('about') : route('localized.about', ['locale' => app()->getLocale()]) }}">
                                                {{___("About Us")}}
                                            </a>

                                        </li>
                                        <li class="menu-item">
                                            <a class="dropdown-item dropdown-toggle" href="{{ app()->getLocale() === config('app.locale') ? route('contact') : route('localized.contact', ['locale' => app()->getLocale()]) }}">
                                                {{___("Contact Us")}}
                                            </a>

                                        </li>
                                        @endmobile
                                    </ul>
                                </nav>
                            </div>
                            <ul class="header-social-icons social-icons d-none d-sm-block">
                                <li class="social-icons-instagram"><a href="https://www.instagram.com/{{config('settings.instagram')}}" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                <li class="social-icons-facebook"><a href="https://www.facebook.com/{{config('settings.facebook')}}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="social-icons-linkedin"><a href="https://www.linkedin.com/showcase/{{config('settings.linkedin')}}" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                            <button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
