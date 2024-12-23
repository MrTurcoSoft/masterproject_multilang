@extends('backend.layouts.admin')
@section('title',siteAyar('author').' | Kataloglar ')
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
                        <h4 class="mb-0 font-size-18">Kataloglar</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Kurumsal Sayfalar</a></li>
                                <li class="breadcrumb-item active">Kataloglar</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <a href="{{route('catalog.create')}}" class='submenu-link'>
                            <button class="btn btn-sm btn-primary mb-5">Yeni Katalog Ekle</button>
                        </a>

                        <div class="card">
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Katalog</th>
                                        <th>Başlık</th>
                                        <th>Durumu</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($catalog as $key=> $value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td style="width: 20%">
                                                <a href="{{$value->file}}" download="{{$value->name}}">
                                                    <img src="{{asset('frontend/img/main/pdf.webp')}}" width="30%" alt="">
                                                </a>
                                            </td>
                                            <td style="width: 40%">
                                                @foreach(['gb', 'de', 'es', 'fr', 'hu', 'it', 'sr'] as $langCode)
                                                    <div>
                                                        {{ $value->{'name_' . $langCode} ?? $value->name }}
                                                        <span class="fi fi-{{ $langCode }}"></span>
                                                    </div>
                                                @endforeach
                                               </td>
                                            <td style="width: 30%">{{$value->isActive == 1 ? 'Aktif' : 'Pasif'}}</td>
                                            <td style="width: 10%">
                                                <button type="button" title="Sil" id="{{$value->id}}" class="btn btn-danger btn-rounded waves-effect waves-light" onclick="deleteFunction({{$value->id}})">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
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
                { title: "#" },
                { title: "Katalog" },
                { title: "Başlık" },
                { title: "Durumu" },
                { title: "İşlemler" }
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
                        url: "{{ route('catalog.delete') }}",
                        data: { id: id },
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
