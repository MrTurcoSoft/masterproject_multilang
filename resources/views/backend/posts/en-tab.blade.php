<div class="tab-pane fade active show" id="en" role="tabpanel"
     aria-labelledby="en">
    <div class="form-group">
        <label for="content">Başlık</label>
        <input type="text" id="title" class="form-control" name="title"
        placeholder="Başlık alanını doldurunuz"
               value="{{ $value->title ?? '' }}">
    </div>
    <div class="form-group">
        <label for="content">İçerik</label>
        <textarea id="content" class="tinymce-editor"
        name="content">{!! $value->content ?? '' !!}</textarea>
    </div>

    <div class="form-group">
        <label for="tags">Etiketler</label>
        <input type="text" id="tags" class="form-control"
               placeholder="Etiketleri Virgülle ayırarak giriniz"
               name="tags"
               value="{{ old('tags', isset($value) ? $value->tags->pluck('name')->implode(', ') : '') }}"
               required>
    </div>


    <hr>
    <h3>Sayfa SEO Ayarları</h3>
    <hr>
    <div class="form-group">
        <label for="simpleinput">Sayfa Başlık</label>
        <input type="text" id="simpleinput" class="form-control"
               name="page_title" placeholder="Başlık alanını doldurunuz"
               value="{{ old('page_title')?: (isset($value) ? $value->page_title : '') }}">
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Açıklama</label>
        <textarea class="form-control" id="exampleFormControlTextarea1"
                  name="page_description"
                  placeholder="Açıklama alanını doldurunuz"
                  rows="5">{{ old('page_description')?: (isset($value) ? $value->page_description : '') }}</textarea>
    </div>

    <div class="form-group">
        <label for="simpleinput">Sayfa Keywords</label>
        <input type="text" id="simpleinput" class="form-control"
               name="page_keywords"
               placeholder="Anahtar kelimeleri virgülle (,) ayırınız"
               value="{{ old('page_keywords')?: (isset($value) ? $value->page_keywords : '') }}">
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Adresi</label>
        <input type="text" id="simpleinput" class="form-control" name="slug"
               placeholder="Kaydettikten sonra otomatik oluşacak" readonly
               value="{{ old('slug')?: (isset($value) ? $value->slug : '') }}">
    </div>
</div>
