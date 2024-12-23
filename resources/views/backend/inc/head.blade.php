<meta charset="utf-8" />
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta content="MrTurco Admin Panel Template" name="description" />
<meta content="MrTurco" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- App favicon -->
<link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">

<!-- App css -->
<link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
<!-- Sweet Alerts css -->
<link href="{{asset('backend/plugins/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

<script src="/backend/tinymce/tinymce.min.js"></script>
<!-- TinyMCE Ana Script -->
@if(siteAyar('tinyMce_api_status') == 1)
    <script src="https://cdn.tiny.cloud/1/{{ __cc('TINY_API_1') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
@else
    <script src="https://cdn.tiny.cloud/1/{{ __cc('TINY_API_2') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
@endif


@yield('page-css')
