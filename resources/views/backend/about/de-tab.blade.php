<div class="tab-pane fade" id="de" role="tabpanel" aria-labelledby="de">
    <!-- Başlık Alanı -->
    <div class="form-group">
        <label for="simpleinput">Başlık</label>
        <input type="text" id="simpleinput" class="form-control" name="name_de"
               placeholder="Başlık alanını doldurunuz"
               value="{{ old('name_de', $value->name_de) }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="de" data-field="name">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-de"></span>
        </button>
    </div>

    <!-- Açıklama Alanı -->
    <div class="form-group">
        <label for="exampleFormControlTextarea1">İçerik</label>
        <textarea class="tinymce-editor" id="description_de"
                  name="description_de">{!! old('description_de', $value->description_de) !!}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="de" data-field="description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-de"></span>
        </button>
    </div>

    <hr>
    <h3>Sayfa SEO Ayarları</h3>
    <hr>
    <div class="form-group">
        <label for="simpleinput">Sayfa Başlık</label>
        <input type="text" id="simpleinput" class="form-control"
               name="page_title_de" placeholder="Başlık alanını doldurunuz"
               value="{{ old('page_title_de', $value->page_title_de) }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="de" data-field="page_title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-de"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Açıklama</label>
        <textarea class="form-control" id="texteditor"
                  name="page_description_de"
                  placeholder="Açıklama alanını doldurunuz"
                  rows="5">{{ old('page_description_de', $value->page_description_de) }}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="de" data-field="page_description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-de"></span>
        </button>

    </div>

    <div class="form-group">
        <label for="simpleinput">Sayfa Keywords</label>
        <input type="text" id="simpleinput" class="form-control"
               name="page_keywords_de"
               placeholder="Anahtar kelimeleri virgülle (,) ayırınız"
               value="{{ old('page_keywords_de', $value->page_keywords_de) }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="de" data-field="page_keywords">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-de"></span>
        </button>

    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Adresi</label>
        <input type="text" id="simpleinput" class="form-control" name="slug_de"
               placeholder="Kaydettikten sonra otomatik oluşacak" readonly
               value="{{ old('slug_de', $value->slug_de) }}">
    </div>

</div>
