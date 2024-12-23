<div class="tab-pane fade" id="es" role="tabpanel" aria-labelledby="es">
    <!-- Başlık Alanı -->
    <div class="form-group">
        <label for="simpleinput">Başlık</label>
        <input type="text" id="simpleinput" class="form-control" name="name_es"
               placeholder="Başlık alanını doldurunuz"
               value="{{ old('name_es', $value->name_es) }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="es" data-field="name">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-es"></span>
        </button>
    </div>

    <!-- Açıklama Alanı -->
    <div class="form-group">
        <label for="exampleFormControlTextarea1">İçerik</label>
        <textarea class="tinymce-editor" id="description_es"
                  name="description_es">{!! old('description_es', $value->description_es) !!}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="es" data-field="description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-es"></span>
        </button>
    </div>

    <hr>
    <h3>Sayfa SEO Ayarları</h3>
    <hr>
    <div class="form-group">
        <label for="simpleinput">Sayfa Başlık</label>
        <input type="text" id="simpleinput" class="form-control"
               name="page_title_es" placeholder="Başlık alanını doldurunuz"
               value="{{ old('page_title_es', $value->page_title_es) }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="es" data-field="page_title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-es"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Açıklama</label>
        <textarea class="form-control" id="texteditor"
                  name="page_description_es"
                  placeholder="Açıklama alanını doldurunuz"
                  rows="5">{{ old('page_description_es', $value->page_description_es) }}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="es" data-field="page_description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-es"></span>
        </button>

    </div>

    <div class="form-group">
        <label for="simpleinput">Sayfa Keywords</label>
        <input type="text" id="simpleinput" class="form-control"
               name="page_keywords_es"
               placeholder="Anahtar kelimeleri virgülle (,) ayırınız"
               value="{{ old('page_keywords_es', $value->page_keywords_es) }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="es" data-field="page_keywords">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-es"></span>
        </button>

    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Adresi</label>
        <input type="text" id="simpleinput" class="form-control" name="slug_es"
               placeholder="Kaydettikten sonra otomatik oluşacak" readonly
               value="{{ old('slug_es', $value->slug_es) }}">
    </div>
</div>
