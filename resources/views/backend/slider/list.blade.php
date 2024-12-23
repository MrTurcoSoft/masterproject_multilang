@extends('backend.layouts.admin')
@section('title',siteAyar('author').' | Slider Listesi ')
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
                        <h4 class="mb-0 font-size-18">Slider Listesi</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Slider Listesi</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <a href="{{route('slider-management.create')}}" class='submenu-link'>
                            <button class="btn btn-sm btn-primary mb-5">Yeni Slider Ekle</button>
                        </a>

                        <div class="card">
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>İçerik</th>
                                        <th>Buton Text</th>
                                        <th>Buton URL</th>
                                        <th>Durumu</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($slider as $key=> $value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td style="width: 30%"><img src="{{$value->image}}" width="20%"></td>
                                            <td style="width: 40%">{{$value->title}}</td>
                                            <td style="width: 10%">{{$value->btnText}}</td>
                                            <td style="width: 10%">{{$value->url}}</td>
                                            <td style="width: 10%">{{$value->isActive == 1 ? 'Aktif' : 'Pasif'}}</td>
                                            <td style="width: 10%">
                                                <a href="{{ route('slider-management.edit', $value->id) }}">
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
                { title: "Image" },
                { title: "İçerik" },
                { title: "Buton Text" },
                { title: "Buton URL" },
                { title: "Durumu" },
                { title: "Action" }
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
                        url: "{{ route('slider.delete') }}",
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
