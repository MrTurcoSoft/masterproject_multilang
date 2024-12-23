<div class="tab-pane fade" id="sr" role="tabpanel" aria-labelledby="sr">
    <div class="form-group">
        <label for="title">Kategori Adı</label>
        <input type="text" id="cat_name_sr" class="form-control" name="cat_name_sr"
               placeholder="Kategori adı alanını doldurunuz"
               value="{{ old('cat_name_sr', $value->cat_name_sr ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="sr" data-field="cat_name">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-sr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="content">Başlık</label>
        <input type="text" id="title_sr" class="form-control" name="title_sr"
               placeholder="Başlık alanını doldurunuz"
               value="{{ old('title_sr', $value->title_sr ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="sr" data-field="title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-sr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="content2">İçerik</label>
        <textarea id="description_sr" class="tinymce-editor"
                  name="description_sr">{!! old('description_sr', $value->description_sr ?? '') !!}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="sr" data-field="description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-sr"></span>
        </button>
    </div>


    <hr>
    <h3>Sayfa SEO Ayarları</h3>
    <hr>
    <div class="form-group">
        <label for="simpleinput">Sayfa Başlık</label>
        <input type="text" id="page_title_sr" class="form-control"
               name="page_title_sr" placeholder="Başlık alanını doldurunuz"
               value="{{ old('page_title_sr', $value->page_title_sr ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="sr" data-field="page_title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-sr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Açıklama</label>
        <textarea class="form-control" id="page_description_sr"
                  name="page_description_sr"
                  placeholder="Açıklama alanını doldurunuz"
                  rows="5">{{ old('page_description_sr', $value->page_description_sr ?? '') }}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="sr" data-field="page_description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-sr"></span>
        </button>
    </div>

    <div class="form-group">
        <label for="simpleinput">Sayfa Keywords</label>
        <input type="text" id="page_keywords_sr" class="form-control"
               name="page_keywords_sr"
               placeholder="Anahtar kelimeleri virgülle (,) ayırınız"
               value="{{ old('page_keywords_sr', $value->page_keywords_sr ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="sr" data-field="page_keywords">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-sr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Adresi</label>
        <input type="text" id="simpleinput" class="form-control" name="slug_sr"
               placeholder="Kaydettikten sonra otomatik oluşacak" readonly
               value="{{ old('slug_sr', $value->slug_sr ?? '') }}">
    </div>
</div>
