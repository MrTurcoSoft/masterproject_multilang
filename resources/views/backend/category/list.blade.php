@extends('backend.layouts.admin')
@section('title',siteAyar('author').' | Kategori Listesi ')
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
                        <h4 class="mb-0 font-size-18">Kategori Listesi</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Kategori Listesi</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <a href="{{route('categories.create')}}" class='submenu-link'>
                            <button class="btn btn-sm btn-primary mb-5">Yeni Kategori Ekle</button>
                        </a>

                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Header Image</th>
                                    <th>Kategorisi</th>
                                    <th>Kategori Adı</th>
                                    <th>Sayfa Başlığı</th>
                                    <th>İçerik</th>
                                    <th>Seo Adres</th>
                                    <th>Ü.Adedi</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $key=> $value)
                                    <tr>
                                        <td class="text-center align-middle" style="width: 5%">{{$key+1}}</td>
                                        <td class="text-center align-middle" style="width: 15%">
                                            @if($value->cat_bg)
                                                <img src="{{$value->cat_bg}}" width="50%">
                                            @else
                                                <label class="btn btn-danger btn-sm">Resim Yok</label>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle" style="width: 5%">
                                            @if($value->ust_id == null)
                                                <label class="btn btn-primary btn-sm">Ana Kategori</label>
                                            @else
                                                <label class="btn btn-warning btn-sm">
                                                    @foreach($categories as $category)
                                                        {{$category->id == $value->ust_id ? $category->cat_name : null}}
                                                    @endforeach
                                                </label>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle" style="width: 15%">
                                            @foreach(['gb', 'de', 'es', 'fr', 'hu', 'it', 'sr'] as $langCode)
                                                <div>
                                                    {{ $value->{'cat_name_' . $langCode} ?? $value->cat_name }}
                                                    <span class="fi fi-{{ $langCode }}"></span>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="text-center align-middle" style="width: 15%">
                                            @foreach(['gb', 'de', 'es', 'fr', 'hu', 'it', 'sr'] as $langCode)
                                                <div>
                                                    {{ $value->{'title_' . $langCode} ?? $value->title }}
                                                    <span class="fi fi-{{ $langCode }}"></span>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="text-center align-middle" style="width: 25%">
                                            @foreach(['gb', 'de', 'es', 'fr', 'hu', 'it', 'sr'] as $langCode)
                                                <div>
                                                    {!! substr(($value->{'description_' . $langCode} ?? $value->description), 0, 80) !!}...
                                                    <span class="fi fi-{{ $langCode }}"></span>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="text-center align-middle" style="width: 15%">
                                            @foreach(['gb', 'de', 'es', 'fr', 'hu', 'it', 'sr'] as $langCode)
                                                <div>
                                                    {{ $value->{'slug_' . $langCode} ?? $value->slug }}
                                                    <span class="fi fi-{{ $langCode }}"></span>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="text-center align-middle" style="width: 2%">{{$value->urunler()->count()}}</td>
                                        <td class="text-center align-middle" style="width: 2%">
                                            @if($value->isActive == 1)
                                                <i style="color:green; font-size:20px" class="mdi mdi-alpha-a-circle"></i>
                                            @else
                                                <i style="color:red; font-size:20px" class="mdi mdi-alpha-p-circle"></i>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle" style="width: 10%">
                                            <a href="{{ route('categories.edit', $value->id) }}">
                                                <button class="btn btn-warning btn-rounded waves-effect waves-light" title="Düzenle">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                            </a>
                                            <button type="button" title="Sil" id="{{$value->id}}" class="btn btn-danger btn-rounded waves-effect waves-light" onclick="deleteFunction({{$value->id}})">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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
                {title: "İçerik"},
                {title: "Seo Adres"},
                {title: "Ürün Adedi"},
                {title: "Durumu"},
                {title: "İşlemler"},
            ]
        });

        function deleteFunction(id) {
            console.log("Silme işlemi başlatıldı. ID: " + id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            alertify.confirm(
                'Kaydı Silmek İstediğinize Emin misiniz?',
                '<b style="color: #f30404;text-transform: uppercase;">ÖNEMLİ UYARI:</b> Kaydı sildiğinizde geri alamazsınız!',
                function () {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('category.delete') }}",
                        data: {id: id},
                        success: function (msg) {
                            console.log("Silme işlemi sonucu: ", msg);
                            if (msg) {
                                $("#item-" + id).remove();
                                alertify.success('Başarıyla silindi');
                                // Sayfayı yenile
                                window.location.reload();
                            } else {
                                alertify.error('Kayıt silinemedi!');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("Hata oluştu: ", xhr.responseText);
                            alertify.error('Silme işlemi başarısız oldu!');
                        }
                    });
                },
                function () {
                    alertify.error('Silme işlemi iptal edildi.');
                }
            );
        }
    </script>

@endsection
