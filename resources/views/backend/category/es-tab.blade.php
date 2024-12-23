<div class="tab-pane fade" id="es" role="tabpanel" aria-labelledby="es">
    <div class="form-group">
        <label for="title">Kategori Adı</label>
        <input type="text" id="cat_name_es" class="form-control" name="cat_name_es"
               placeholder="Kategori adı alanını doldurunuz"
               value="{{ old('cat_name_es', $value->cat_name_es ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="es" data-field="cat_name">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-es"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="content">Başlık</label>
        <input type="text" id="title_es" class="form-control" name="title_es"
               placeholder="Başlık alanını doldurunuz"
               value="{{ old('title_es', $value->title_es ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="es" data-field="title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-es"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="content2">İçerik</label>
        <textarea id="description_es" class="tinymce-editor"
                  name="description_es">{!! old('description_es', $value->description_es ?? '') !!}</textarea>
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
        <input type="text" id="page_title_es" class="form-control"
               name="page_title_es" placeholder="Başlık alanını doldurunuz"
               value="{{ old('page_title_es', $value->page_title_es ?? '') }}">
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
        <textarea class="form-control" id="page_description_es"
                  name="page_description_es"
                  placeholder="Açıklama alanını doldurunuz"
                  rows="5">{{ old('page_description_es', $value->page_description_es ?? '') }}</textarea>
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
        <input type="text" id="page_keywords_es" class="form-control"
               name="page_keywords_es"
               placeholder="Anahtar kelimeleri virgülle (,) ayırınız"
               value="{{ old('page_keywords_es', $value->page_keywords_es ?? '') }}">
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
               value="{{ old('slug_es', $value->slug_es ?? '') }}">
    </div>
</div>
