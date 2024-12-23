@extends('admin.layouts.admin')
@section('title',SiteHelpers::ayar('author').' | Hakkımızda Sayfası ')
@section('page-css')
    {{--sayfaya özel css kodlarını eklemek için kullanın--}}

@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Hakkımızda</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Kurumsal Sayfalar</a></li>
                                <li class="breadcrumb-item active">Hakkımızda</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

@endsection


@section('page-js')

    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".delete").click(function () {
                destroy_id = $(this).attr('id');
                console.log(destroy_id);
                alertify.confirm('Kaydı Silmek İstediğinize Emin misiniz?', '<b style="color: #f30404;text-transform: uppercase;">ÖNEMLİ UYARI:</b> Kaydı sildiğinizde geri alamazsınız!',


                    function () {
                        $.ajax({
                            type: "POST",
                            url: "certificates/delete",
                            data: "id=" + destroy_id,
                            success: function (msg) {
                                console.log(msg);
                                if (msg) {
                                    $("#item-" + destroy_id).remove();
                                    alertify.success('Başarıyla silindi');
                                    document.location.reload(true);
                                } else {
                                    alertify.error('Kayıt silinemedi!');

                                }
                            }
                        });

                    },
                    function () {
                        alertify.error('Silme işlemi iptal edildi.')
                    }
                )
                ;

            });
        });
    </script>

@endsection
