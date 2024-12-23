@extends('backend.layouts.admin')
@section('title',siteAyar('author').' | Ürünler Listesi ')
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
                        <h4 class="mb-0 font-size-18">Ürünler Listesi</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Ürünler Listesi</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <a href="{{route('products.create')}}" class='submenu-link'>
                            <button class="btn btn-sm btn-primary mb-5">Yeni Ürün Ekle</button>
                        </a>

                        <div class="card">
                            <div class="card-body">
                                <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Kategorisi</th>
                                        <th>Ürün Adı</th>
                                        <th>Modeli</th>
                                        <th>İçerik</th>
                                        <th>Sıra</th>
                                        <th>Seo Adresi</th>
                                        <th>Durumu</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $key=> $value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td style="width: 40%">@if($value->image) <img src="{{$value->image}}" width="50%">@else
                                                    <label class="btn btn-danger btn-sm">Resim Yok</label> @endif</td>
                                            @foreach($value->kategoriler as $category)
                                                <td style="width: 20%">{{SiteHelpers::getCategoryName($category->id)}}</td>
                                            @endforeach
                                            <td style="width: 20%">{{$value->name}}</td>
                                            <td style="width: 20%">{{$value->title}}</td>
                                            <td style="width: 50%">{!! substr($value->description,0,30) !!}...</td>
                                            <td style="width: 5%">{{$value->must}}</td>
                                            <td class="text-center align-middle" style="width: 15%">
                                                <div>{{$value->slug}} <span class="fi fi-gb"></span></div>
                                                <div>{{$value->slug_de}} <span class="fi fi-de"></span></div>
                                                <div>{{$value->slug_es}} <span class="fi fi-es"></span></div>
                                                <div>{{$value->slug_fr}} <span class="fi fi-fr"></span></div>
                                                <div>{{$value->slug_hu}} <span class="fi fi-hu"></span></div>
                                                <div>{{$value->slug_it}} <span class="fi fi-it"></span></div>
                                                <div>{{$value->slug_sr}} <span class="fi fi-sr"></span></div>
                                            </td>
                                            <td class="text-center align-middle" style="width: 5%">
                                                @if($value->isActive == 1)
                                                    <i style="color:green; font-size:20px" class="mdi mdi-alpha-a-circle"></i>
                                                @else
                                                    <i style="color:red; font-size:20px" class="mdi mdi-alpha-p-circle"></i>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle" style="width: 10%">
                                                <a href="{{ route('products.edit', $value->id) }}">
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
                        url: "{{ route('products.delete') }}",
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
