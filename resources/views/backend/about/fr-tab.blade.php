<div class="tab-pane fade" id="fr" role="tabpanel" aria-labelledby="fr">
    <!-- Başlık Alanı -->
    <div class="form-group">
        <label for="simpleinput">Başlık</label>
        <input type="text" id="simpleinput" class="form-control" name="name_fr"
               placeholder="Başlık alanını doldurunuz"
               value="{{ old('name_fr', $value->name_fr) }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="fr" data-field="name">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-fr"></span>
        </button>
    </div>

    <!-- Açıklama Alanı -->
    <div class="form-group">
        <label for="exampleFormControlTextarea1">İçerik</label>
        <textarea class="tinymce-editor" id="description_fr"
                  name="description_fr">{!! old('description_fr', $value->description_fr) !!}</textarea>
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
        <input type="text" id="simpleinput" class="form-control"
               name="page_title_fr" placeholder="Başlık alanını doldurunuz"
               value="{{ old('page_title_fr', $value->page_title_fr) }}">
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
        <textarea class="form-control" id="texteditor"
                  name="page_description_fr"
                  placeholder="Açıklama alanını doldurunuz"
                  rows="5">{{ old('page_description_fr', $value->page_description_fr) }}</textarea>
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
        <input type="text" id="simpleinput" class="form-control"
               name="page_keywords_fr"
               placeholder="Anahtar kelimeleri virgülle (,) ayırınız"
               value="{{ old('page_keywords_fr', $value->page_keywords_fr) }}">
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
               value="{{ old('slug_fr', $value->slug_fr) }}">
    </div>
</div>
