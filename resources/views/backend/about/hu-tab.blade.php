<div class="tab-pane fade" id="hu" role="tabpanel" aria-labelledby="hu">
    <!-- Başlık Alanı -->
    <div class="form-group">
        <label for="simpleinput">Başlık</label>
        <input type="text" id="simpleinput" class="form-control" name="name_hu"
               placeholder="Başlık alanını doldurunuz"
               value="{{ old('name_hu', $value->name_hu) }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="hu" data-field="name">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-hu"></span>
        </button>
    </div>

    <!-- Açıklama Alanı -->
    <div class="form-group">
        <label for="exampleFormControlTextarea1">İçerik</label>
        <textarea class="tinymce-editor" id="description_hu"
                  name="description_hu">{!! old('description_hu', $value->description_hu) !!}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="hu" data-field="description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-hu"></span>
        </button>
    </div>

    <hr>
    <h3>Sayfa SEO Ayarları</h3>
    <hr>
    <div class="form-group">
        <label for="simpleinput">Sayfa Başlık</label>
        <input type="text" id="simpleinput" class="form-control"
               name="page_title_hu" placeholder="Başlık alanını doldurunuz"
               value="{{ old('page_title_hu', $value->page_title_hu) }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="hu" data-field="page_title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-hu"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Açıklama</label>
        <textarea class="form-control" id="texteditor"
                  name="page_description_hu"
                  placeholder="Açıklama alanını doldurunuz"
                  rows="5">{{ old('page_description_hu', $value->page_description_hu) }}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="hu" data-field="page_description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-hu"></span>
        </button>

    </div>

    <div class="form-group">
        <label for="simpleinput">Sayfa Keywords</label>
        <input type="text" id="simpleinput" class="form-control"
               name="page_keywords_hu"
               placeholder="Anahtar kelimeleri virgülle (,) ayırınız"
               value="{{ old('page_keywords_hu', $value->page_keywords_hu) }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="hu" data-field="page_keywords">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-hu"></span>
        </button>

    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Adresi</label>
        <input type="text" id="simpleinput" class="form-control" name="slug_hu"
               placeholder="Kaydettikten sonra otomatik oluşacak" readonly
               value="{{ old('slug_hu', $value->slug_hu) }}">
    </div>
</div>
