<div class="tab-pane fade" id="fr" role="tabpanel" aria-labelledby="fr">

    <div class="form-group">
        <label for="title">Kategori Adı</label>
        <input type="text" id="cat_name_fr" class="form-control" name="cat_name_fr"
               placeholder="Kategori adı alanını doldurunuz"
               value="{{ old('cat_name_fr', $value->cat_name_fr ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="fr" data-field="cat_name">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-fr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="content">Başlık</label>
        <input type="text" id="title_fr" class="form-control" name="title_fr"
               placeholder="Başlık alanını doldurunuz"
               value="{{ old('title_fr', $value->title_fr ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="fr" data-field="title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-fr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="content2">İçerik</label>
        <textarea id="description_fr" class="tinymce-editor"
                  name="description_fr">{!! old('description_fr', $value->description_fr ?? '') !!}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="fr" data-field="description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-fr"></span>
        </button>
    </div>


    <hr>
    <h3>Sayfa SEO Ayarları</h3>
    <hr>
    <div class="form-group">
        <label for="simpleinput">Sayfa Başlık</label>
        <input type="text" id="page_title_fr" class="form-control"
               name="page_title_fr" placeholder="Başlık alanını doldurunuz"
               value="{{ old('page_title_fr', $value->page_title_fr ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="fr" data-field="page_title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-fr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Açıklama</label>
        <textarea class="form-control" id="page_description_fr"
                  name="page_description_fr"
                  placeholder="Açıklama alanını doldurunuz"
                  rows="5">{{ old('page_description_fr', $value->page_description_fr ?? '') }}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="fr" data-field="page_description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-fr"></span>
        </button>
    </div>

    <div class="form-group">
        <label for="simpleinput">Sayfa Keywords</label>
        <input type="text" id="page_keywords_fr" class="form-control"
               name="page_keywords_fr"
               placeholder="Anahtar kelimeleri virgülle (,) ayırınız"
               value="{{ old('page_keywords_fr', $value->page_keywords_fr ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="fr" data-field="page_keywords">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-fr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Adresi</label>
        <input type="text" id="simpleinput" class="form-control" name="slug_fr"
               placeholder="Kaydettikten sonra otomatik oluşacak" readonly
               value="{{ old('slug_fr', $value->slug_fr ?? '') }}">
    </div>
</div>
