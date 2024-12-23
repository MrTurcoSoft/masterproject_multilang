<div class="tab-pane fade active show" id="en" role="tabpanel"
     aria-labelledby="en">
    <div class="form-group">
        <label for="simpleinput">Başlık</label>
        <input type="text" id="simpleinput" class="form-control" name="name"
               placeholder="Başlık alanını doldurunuz"
               value="{{ old('name', $value->name) }}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">İçerik</label>
        <textarea id="description" class="tinymce-editor"
                  name="description">{!! old('description', $value->description) !!}</textarea>
    </div>
    <hr>
    <h3>Sayfa SEO Ayarları</h3>
    <hr>
    <div class="form-group">
        <label for="simpleinput">Sayfa Başlık</label>
        <input type="text" id="simpleinput" class="form-control"
               name="page_title" placeholder="Başlık alanını doldurunuz"
               value="{{ old('page_title', $value->page_title) }}">
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Açıklama</label>
        <textarea class="form-control" id="exampleFormControlTextarea1"
                  name="page_description"
                  placeholder="Açıklama alanını doldurunuz"
                  rows="5">{{ old('page_description', $value->page_description) }}</textarea>
    </div>

    <div class="form-group">
        <label for="simpleinput">Sayfa Keywords</label>
        <input type="text" id="simpleinput" class="form-control"
               name="page_keywords"
               placeholder="Anahtar kelimeleri virgülle (,) ayırınız"
               value="{{ old('page_keywords', $value->page_keywords) }}">
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Adresi</label>
        <input type="text" id="simpleinput" class="form-control" name="slug"
               placeholder="Kaydettikten sonra otomatik oluşacak" readonly
               value="{{ old('slug', $value->slug) }}">
    </div>
</div>
