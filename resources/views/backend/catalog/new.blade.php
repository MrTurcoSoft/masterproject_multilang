@extends('backend.layouts.admin')
@section('title',SiteHelpers::ayar('author').' | Yeni Katalog ')
@section('page-css')
    <!-- Dropify css -->
    <link href="{{asset('backend/plugins/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Plugins css -->
    <link href="{{asset('backend/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('backend/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/plugins/switchery/switchery.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('backend/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <style>
        .tab-pane {
            display: none; /* Tüm tab içeriklerini gizle */
        }

        .tab-pane.active {
            display: block; /* Sadece aktif olan tabı göster */
        }
    </style>

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
                                <li class="breadcrumb-item active">Yeni Katalog</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="col-xl-12">
                <div class="card card-animate">
                    <div class="card-body">
                        <h4 class="card-title">Yeni Katalog</h4>

                        <div class="row">


                            <div class="col-sm-4">
                                <form class="form form-vertical" method="post"
                                      action="{{route("catalog.store")}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body col-sm-6 mb-5">
                                        <h4 class="card-title">Katalog</h4>
                                        <p class="card-subtitle mb-4">Yanlızca PDF belgesi</p>
                                        <input type="file"
                                               class="dropify" name="file"
                                               data-max-file-size="10M"/>
                                    </div> <!-- end card-body-->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Katalog İsmi</label>
                                            <input type="text" id="email-id-vertical" class="form-control"
                                                   name="name" required>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-warning waves-effect waves-light">Yükle</button>
                                    </div>
                                </form>
                            </div> <!-- end col-->


                        </div> <!-- end row-->

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

@endsection


@section('page-js')

    <!--dropify-->
    <script src="{{asset('backend/plugins/dropify/dropify.min.js')}}"></script>

    <!-- Init js-->
    <script src="{{asset('backend/assets/pages/fileuploads-demo.js')}}"></script>

@endsection
