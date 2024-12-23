@extends('backend.layouts.admin')
@section('title',siteAyar('author').' | Blog Posts ')
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
                        <h4 class="mb-0 font-size-18">Blog Posts</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Blog Posts</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <a href="{{route('posts.create')}}" class='submenu-link'>
                            <button class="btn btn-sm btn-primary mb-5">Yeni Blog Yazısı Ekle</button>
                        </a>
                        <div class="card">
                            <div class="card-body">
                                <table id="example"  class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Başlık</th>
                                        <th>Görüntüleme Sayısı</th>
                                        <th>Yayın Tarihi</th>
                                        <th>Yazan</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $key=> $value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td style="width: 40%">@if($value->image) <img src="{{$value->image}}" width="50%">@else
                                                    <label class="btn btn-danger btn-sm">Resim Yok</label> @endif</td>
                                            <td style="width: 20%">{{$value->title}}</td>
                                            <td style="width: 5%">{{$value->views}}</td>
                                            <td style="width: 5%">{{$value->created_at}}</td>
                                            <td>{{$value->author}}</td>
                                            <td class="text-center align-middle" style="width: 10%">
                                                <a href="{{route('posts.edit',$value->id)}}">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        new DataTable('#example', {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/tr.json'
            }
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
                        url: "{{ route('blog-posts.delete') }}",
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
