@extends('backend.layouts.admin')
@section('title',siteAyar('author').' | Ana Sayfa Yönetimi ')
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
                        <h4 class="mb-0 font-size-18">Ana Sayfa Yönetimi</h4>

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
                                        <th>Bölüm No</th>
                                        <th>Image</th>
                                        <th>Başlık</th>
                                        <th>İçerik</th>
                                        <th>Buton Text</th>
                                        <th>Buton URL</th>
                                        <th>Durumu</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sections as $key=> $value)
                                        <tr>
                                            <td style="width: 5%">{{$value->section}}. Bölüm</td>
                                            <td style="width: 30%">@if($value->image) <img src="{{$value->image}}" width="70%">@else
                                                    <label class="btn btn-danger btn-sm">Resim Yok</label> @endif</td>
                                            <td style="width: 7%"> @foreach(['gb', 'de', 'es', 'fr', 'hu', 'it', 'sr'] as $langCode)
                                                    <div>
                                                        {{ $value->{'title_' . $langCode} ?? $value->title }}
                                                        <span class="fi fi-{{ $langCode }}"></span>
                                                    </div>
                                                @endforeach</td>
                                            <td style="width: 30%"> @foreach(['gb', 'de', 'es', 'fr', 'hu', 'it', 'sr'] as $langCode)
                                                    <div>
                                                        {!! substr(($value->{'description_' . $langCode} ?? $value->description), 0, 80) !!}...
                                                        <span class="fi fi-{{ $langCode }}"></span>
                                                    </div>
                                                @endforeach</td>
                                            <td style="width: 3%">
                                                @isset($value->btnText)
                                                @foreach(['gb', 'de', 'es', 'fr', 'hu', 'it', 'sr'] as $langCode)
                                                    <div>
                                                        {{ $value->{'btnText_' . $langCode} ?? $value->btnText }}
                                                        <span class="fi fi-{{ $langCode }}"></span>
                                                    </div>
                                                @endforeach
                                                @endisset</td>
                                            <td style="width: 40%">
                                                @isset($value->url)
                                                @foreach(['gb', 'de', 'es', 'fr', 'hu', 'it', 'sr'] as $langCode)
                                                    <div>
                                                        {{ $value->{'url_' . $langCode} ?? $value->url }}
                                                        <span class="fi fi-{{ $langCode }}"></span>
                                                    </div>
                                                @endforeach
                                                @endisset
                                            </td>
                                            <td class="text-center align-middle" style="width: 5%">
                                                @if($value->isActive == 1)
                                                    <i style="color:green; font-size:20px" class="mdi mdi-alpha-a-circle"></i>
                                                @else
                                                    <i style="color:red; font-size:20px" class="mdi mdi-alpha-p-circle"></i>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle" style="width: 10%">
                                                <a href="homesections/{{$value->id}}/{{$value->section}}">
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
