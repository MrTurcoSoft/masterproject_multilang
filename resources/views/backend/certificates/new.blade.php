@extends('backend.layouts.admin')
@section('title',SiteHelpers::ayar('author').' | Sertifikalarımız ')
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
                        <h4 class="mb-0 font-size-18">Sertifikalarımız/Belgelerimiz</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Kurumsal Sayfalar</a></li>
                                <li class="breadcrumb-item active">Sertifikalarımız</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="col-xl-12">
                <div class="card card-animate">
                    <div class="card-body">
                        <h4 class="card-title">Sertifikalarımız</h4>
                        <p class="card-subtitle mb-4">Sertifika ve Belgelerinizi buradan yükleyebilirsiniz</p>

                        <div class="row">


                            <div class="col-sm-4">
                                <form class="form form-vertical" method="post"
                                      action="{{route("certificates.store")}}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="tab-content mt-3" id="v-pills-tabContent-right">
                                        <!--  İngilizce Dil Dosyaları -->
                                        @include('backend.certificates.en-tab')
                                        <!--  Almanca Dil Dosyaları -->
                                        @include('backend.certificates.de-tab')
                                        <!--  İspanyolca Dil Dosyaları -->
                                        @include('backend.certificates.es-tab')
                                        <!--  Fransızca Dil Dosyaları -->
                                        @include('backend.certificates.fr-tab')
                                        <!--  Macarca Dil Dosyaları -->
                                        @include('backend.certificates.hu-tab')
                                        <!--  İtalyanca Dil Dosyaları -->
                                        @include('backend.certificates.it-tab')
                                        <!--  Sırpça Dil Dosyaları -->
                                        @include('backend.certificates.sr-tab')
                                    </div> <!-- end tabcontent-->
                                    <div class="card-body col-sm-6 mb-5">
                                        <h4 class="card-title">Sertifika/Belge</h4>
                                        <p class="card-subtitle mb-4">Yanlızca 600x800 px ölçülerinde</p>
                                        <input type="file"
                                               class="dropify" name="image"
                                               data-max-file-size="2M"/>
                                    </div> <!-- end card-body-->
                                    <div class="card-footer">
                                        <button class="btn btn-warning waves-effect waves-light">Yükle</button>
                                    </div>
                                </form>
                            </div> <!-- end col-->

                            @include('backend.inc.tab-lang')

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



    <script>


        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.translate-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const lang = this.getAttribute('data-lang'); // Hedef dil kodu (ör. 'de')
                    const field = this.getAttribute('data-field'); // Kaynak alan (ör. 'description')

                    console.log(`Çeviri başlatıldı: Dil - ${lang}, Alan - ${field}`);

                    // TinyMCE veya standart textarea alanından içerik al
                    let textToTranslate = '';
                    const sourceEditor = tinymce.get(field); // TinyMCE editörünü al

                    if (sourceEditor) {
                        textToTranslate = sourceEditor.getContent().trim(); // TinyMCE'den içerik al
                    } else {
                        const sourceField = document.querySelector(`[name="${field}"]`);
                        if (sourceField) {
                            textToTranslate = sourceField.value.trim(); // Standart textarea'dan içerik al
                        }
                    }

                    if (!textToTranslate) {
                        Swal.fire({
                            type: 'error',
                            title: 'Eksik Bilgi!',
                            html: `Lütfen ${field} alanını doldurun.`,
                            confirmButtonText: 'Tamam'
                        });
                        return;
                    }

                    console.log(`Kaynak alan içeriği alındı: ${textToTranslate}`);

                    // Hedef alanı belirle
                    const targetFieldName = `${field}_${lang}`; // Hedef alan ismi oluştur (ör. 'description_de')
                    const targetEditor = tinymce.get(targetFieldName);
                    const targetField = document.querySelector(`[name="${targetFieldName}"]`);

                    if (!targetEditor && !targetField) {
                        console.error(`Hedef alan bulunamadı: ${targetFieldName}`);
                        return;
                    }

                    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                    if (csrfTokenMeta) {
                        const csrfToken = csrfTokenMeta.getAttribute('content');

                        this.innerHTML = 'Çeviriliyor...';
                        this.disabled = true;

                        fetch('/api/deepl-translate', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({
                                lang: lang,
                                text: textToTranslate,
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                console.log('Çeviri yanıtı alındı:', data);
                                if (data.success) {
                                    // Çeviri sonucunu hedef alana yaz
                                    if (targetEditor) {
                                        targetEditor.setContent(data.translatedText); // TinyMCE editörüne yaz
                                    } else if (targetField) {
                                        targetField.value = data.translatedText; // Standart textarea'ya yaz
                                    }

                                    console.log(`Hedef alan güncellendi: ${data.translatedText}`);
                                } else {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Hata!',
                                        html: `Çeviri başarısız oldu!`,
                                        confirmButtonText: 'Tamam'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Hata:', error);
                                Swal.fire({
                                    type: 'error',
                                    title: 'Hata!',
                                    html: `Bir Hata Oluştu!`,
                                    confirmButtonText: 'Tamam'
                                });
                            })
                            .finally(() => {
                                this.innerHTML = 'Çeviri Tamamlandı!';
                                this.disabled = true;
                            });
                    } else {
                        console.error('CSRF token meta elementi bulunamadı');
                    }
                });
            });


        });


    </script>

@endsection
