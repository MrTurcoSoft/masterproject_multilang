<div class="tab-pane fade" id="it" role="tabpanel" aria-labelledby="it">
    <div class="form-group">
        <label for="title">Kategori Adı</label>
        <input type="text" id="cat_name_it" class="form-control" name="cat_name_it"
               placeholder="Kategori adı alanını doldurunuz"
               value="{{ old('cat_name_it', $value->cat_name_it ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="it" data-field="cat_name">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-it"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="content">Başlık</label>
        <input type="text" id="title_it" class="form-control" name="title_it"
               placeholder="Başlık alanını doldurunuz"
               value="{{ old('title_it', $value->title_it ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="it" data-field="title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-it"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="content2">İçerik</label>
        <textarea id="description_it" class="tinymce-editor"
                  name="description_it">{!! old('description_it', $value->description_it ?? '') !!}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="it" data-field="description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-it"></span>
        </button>
    </div>


    <hr>
    <h3>Sayfa SEO Ayarları</h3>
    <hr>
    <div class="form-group">
        <label for="simpleinput">Sayfa Başlık</label>
        <input type="text" id="page_title_it" class="form-control"
               name="page_title_it" placeholder="Başlık alanını doldurunuz"
               value="{{ old('page_title_it', $value->page_title_it ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="it" data-field="page_title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-it"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Açıklama</label>
        <textarea class="form-control" id="page_description_it"
                  name="page_description_it"
                  placeholder="Açıklama alanını doldurunuz"
                  rows="5">{{ old('page_description_it', $value->page_description_it ?? '') }}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="it" data-field="page_description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-it"></span>
        </button>
    </div>

    <div class="form-group">
        <label for="simpleinput">Sayfa Keywords</label>
        <input type="text" id="page_keywords_it" class="form-control"
               name="page_keywords_it"
               placeholder="Anahtar kelimeleri virgülle (,) ayırınız"
               value="{{ old('page_keywords_it', $value->page_keywords_it ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="it" data-field="page_keywords">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-it"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Adresi</label>
        <input type="text" id="simpleinput" class="form-control" name="slug_it"
               placeholder="Kaydettikten sonra otomatik oluşacak" readonly
               value="{{ old('slug_it', $value->slug_it ?? '') }}">
    </div>
</div>
