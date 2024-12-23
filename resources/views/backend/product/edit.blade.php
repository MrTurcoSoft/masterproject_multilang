@extends('backend.layouts.admin')
@section('title',SiteHelpers::ayar('author').' | Ürün Düzenle ')
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

    <!-- App css -->
    <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />
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
                        <h4 class="mb-0 font-size-18">Ürün Düzenle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Ürün Yönetimi</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="col-xl-12">
                <div class="card card-animate">
                    <div class="card-body">
                        <h4 class="card-title">Ürün Düzenle</h4>

                        <div class="row">
                            <div class="col-sm-8">
                                <form class="form form-vertical" method="post"
                                      action="{{route("products.update",$value->id)}}" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="card-body col-sm-6 mb-5">
                                        <h4 class="card-title">Ürün Resmi</h4>
                                        <p class="card-subtitle mb-4" style="color: red;font-weight: bold">Yanlızca 800X600 px ölçülerinde</p>
                                        <input type="file"
                                               class="dropify"
                                               name="image"
                                               data-max-file-size="2M"
                                               data-default-file="{{ isset($value) && $value->image ? asset($value->image) : '' }}"/>
                                    </div> <!-- end card-body-->

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="categories[]">Ürün Kategori</label>
                                            <select class="form-control select2-multiple" data-toggle="select2" name="categories[]" multiple="multiple" data-placeholder="Kategori Seçiniz ...">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                            @if(isset($value) && in_array($category->id, $value->kategoriler->pluck('id')->toArray())) selected @endif>
                                                        {{ $category->cat_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="must">Sıralaması</label>
                                            <input type="text" data-toggle="touchspin" name="must"
                                                   value="{{  $value->must }}" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="hidden" name="isActive" value="0">
                                            <input type="checkbox" data-toggle="switchery" data-color="#38b3d6" data-secondary-color="#df3554" name="isActive" value="1"
                                                {{  old('isActive', isset($value) && $value->isActive == 1 ) ? 'checked' : '' }}/>
                                            <label class="form-check-label">Pasif/Aktif</label>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-3" style="gap: 20px;">
                                        <!-- Tab Content -->
                                        <div class="tab-content flex-fill" id="v-pills-tabContent-right">
                                            <!-- İngilizce Dil Dosyaları -->
                                            @include('backend.product.en-tab')
                                            <!-- Almanca Dil Dosyaları -->
                                            @include('backend.product.de-tab')
                                            <!-- İspanyolca Dil Dosyaları -->
                                            @include('backend.product.es-tab')
                                            <!-- Fransızca Dil Dosyaları -->
                                            @include('backend.product.fr-tab')
                                            <!-- Macarca Dil Dosyaları -->
                                            @include('backend.product.hu-tab')
                                            <!-- İtalyanca Dil Dosyaları -->
                                            @include('backend.product.it-tab')
                                            <!-- Sırpça Dil Dosyaları -->
                                            @include('backend.product.sr-tab')
                                        </div>

                                        <!-- Tab Lang -->
                                        <div>
                                            @include('backend.inc.tab-lang')
                                        </div>
                                    </div>
                                    <hr>
                                    <h3>Ürün Detayları&nbsp;</h3> <br>
                                    <hr>
                                    <table style="border-collapse: collapse; width: 100%;" border="1">
                                        <tbody>
                                        <tr>
                                            <td style="width: 100%; text-align: center;background: #1c75fa;color: #ffffff;font-weight: bold">
                                                PRODUCT SPESIFICATIONS
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <table class="mb-10" style="border-collapse: collapse; width: 100%;border:#ffffff;">
                                        <tbody>
                                        <tr>
                                            <td style="width: 50%;background: #d6e6ff"><b>Volume/Pack Of</b></td>
                                            <td style="width: 50%;background: #d6e6ff"><input type="text" id="contact-info-vertical" class="form-control"
                                                                                              name="volume" value="{{$value->detay->volume}}"  required></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;"><b>Box Sizes</b></td>
                                            <td style="width: 50%;background: #d6e6ff"><input type="text" id="contact-info-vertical" class="form-control"
                                                                                              name="boxsize" value="{{$value->detay->boxsize}}"  required></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;background: #d6e6ff"><b>Quantity in Box</b></td>
                                            <td style="width: 50%;background: #d6e6ff"><input type="text" id="contact-info-vertical" class="form-control"
                                                                                              name="qtyBox" value="{{$value->detay->qtyBox}}"  required></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;"><b>Box Net Weight</b></td>
                                            <td style="width: 50%;background: #d6e6ff"><input type="text" id="contact-info-vertical" class="form-control"
                                                                                              name="BoxNetW" value="{{$value->detay->BoxNetW}}" required></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;background: #d6e6ff"><b>Box Gross Weight</b></td>
                                            <td style="width: 50%;background: #d6e6ff"><input type="text" id="contact-info-vertical" class="form-control"
                                                                                              name="BoxGrossW" value="{{$value->detay->BoxGrossW}}" required></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;"><b>Boxes on Pallet</b></td>
                                            <td style="width: 50%;background: #d6e6ff"><input type="text" id="contact-info-vertical" class="form-control"
                                                                                              name="BoxOnPallet" value="{{$value->detay->BoxOnPallet}}" required></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;background: #d6e6ff"><b>HS CODE</b></td>
                                            <td style="width: 50%;background: #d6e6ff"><input type="text" id="contact-info-vertical" class="form-control"
                                                                                              name="hsCode" value="{{$value->detay->hsCode}}" required></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;"><b>BARCODE</b></td>
                                            <td style="width: 50%;background: #d6e6ff"><input type="text" id="contact-info-vertical" class="form-control"
                                                                                              name="barcode" value="{{$value->detay->barcode}}" required></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="card-footer">
                                        <button class="btn btn-warning waves-effect waves-light">Güncelle</button>
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

    <!-- Plugins js -->
    <script src="{{asset('backend/plugins/autonumeric/autoNumeric-min.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('backend/plugins/moment/moment.js')}}"></script>
    <script src="{{asset('backend/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('backend/plugins/switchery/switchery.min.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{asset('backend/assets/pages/advanced-plugins-demo.js')}}"></script>

    <script>


        document.addEventListener('DOMContentLoaded', function () {
            const languages = [
                'description',
                'description_de',
                'description_es',
                'description_fr',
                'description_hu',
                'description_it',
                'description_sr'
            ];

            languages.forEach(lang => {
                tinymce.init({
                    selector: `#${lang}`,
                    plugins: 'lists link image table media',
                    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | bullist numlist | link image | media',
                    height: 300,
                });
            });

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
