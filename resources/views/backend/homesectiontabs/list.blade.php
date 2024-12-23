@extends('backend.layouts.admin')
@section('title',siteAyar('author').' | Ana Sayfa Tab Bölümleri ')
@section('page-css')
    {{--sayfaya özel css kodlarını eklemek için kullanın--}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Ana Sayfa Tab Bölümleri</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Ana Sayfa Yönetimi</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table  class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Başlık</th>
                                        <th>İçerik</th>
                                        <th>Buton Text</th>
                                        <th>Buton URL</th>
                                        <th>Durumu</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sections as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td style="width: 30%">
                                                @if($value->image)
                                                    <img src="{{ $value->image }}" width="30%">
                                                @else
                                                    <label class="btn btn-danger btn-sm">Resim Yok</label>
                                                @endif
                                            </td>
                                            <td style="width: 20%">
                                                @foreach(['gb', 'de', 'es', 'fr', 'hu', 'it', 'sr'] as $langCode)
                                                    <div>
                                                        {{ $value->{'title_' . $langCode} ?? $value->title }}
                                                        <span class="fi fi-{{ $langCode }}"></span>
                                                    </div>
                                                @endforeach
                                                </td>
                                            <td style="width: 50%">
                                                @foreach(['gb', 'de', 'es', 'fr', 'hu', 'it', 'sr'] as $langCode)
                                                    <div>
                                                        {!! substr(($value->{'description_' . $langCode} ?? $value->description), 0, 80) !!}...
                                                        <span class="fi fi-{{ $langCode }}"></span>
                                                    </div>
                                                @endforeach
                                            <td style="width: 10%">
                                                @foreach(['gb', 'de', 'es', 'fr', 'hu', 'it', 'sr'] as $langCode)
                                                    <div>
                                                        {{ $value->{'btnText_' . $langCode} ?? $value->btnText }}
                                                        <span class="fi fi-{{ $langCode }}"></span>
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td style="width: 40%">
                                                @foreach(['gb', 'de', 'es', 'fr', 'hu', 'it', 'sr'] as $langCode)
                                                    <div>
                                                        {{ $value->{'url_' . $langCode} ?? $value->url }}
                                                        <span class="fi fi-{{ $langCode }}"></span>
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td class="text-center align-middle" style="width: 5%">
                                                @if($value->isActive)
                                                    <i style="color:green; font-size:20px" class="mdi mdi-alpha-a-circle"></i>
                                                @else
                                                    <i style="color:red; font-size:20px" class="mdi mdi-alpha-p-circle"></i>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle" style="width: 10%">
                                                <a href="{{ route('sectiontabs.edit', $value->id) }}">
                                                    <button class="btn btn-warning btn-rounded waves-effect waves-light" title="Düzenle">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </section>
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

@endsection


@section('page-js')

    <script>
        let table = new DataTable('#myTable', {
            columns: [
                {title: "#"},
                {title: "Header Image"},
                {title: "Kategorisi"},
                {title: "Kategori Adı"},
                {title: "Sayfa Başlığı"},
                {title: "çerik"},
                {title: "Seo Adres"},
                {title: "Ürün Adedi"},
                {title: "Durumu"},
                {title: "İşlemler"},
            ]
        });

    </script>

@endsection
