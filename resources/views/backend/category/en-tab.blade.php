<div class="tab-pane fade active show" id="en" role="tabpanel"
     aria-labelledby="en">
    <div class="form-group">
        <label for="title">Kategori Adı</label>
        <input type="text" id="cat_name" class="form-control" name="cat_name"
               placeholder="Kategori adı alanını doldurunuz"
               value="{{ old('cat_name', $value->cat_name ?? '') }}">
    </div>
    <div class="form-group">
        <label for="content">Başlık</label>
        <input type="text" id="title" class="form-control" name="title"
               placeholder="Başlık alanını doldurunuz"
               value="{{ old('title', $value->title ?? '') }}">
    </div>
    <div class="form-group">
        <label for="content2">İçerik</label>
        <textarea id="description" class="tinymce-editor"
                  name="description">{!! old('description', $value->description ?? '') !!}</textarea>
    </div>


    <hr>
    <h3>Sayfa SEO Ayarları</h3>
    <hr>
    <div class="form-group">
        <label for="simpleinput">Sayfa Başlık</label>
        <input type="text" id="simpleinput" class="form-control"
               name="page_title" placeholder="Başlık alanını doldurunuz"
               value="{{ old('page_title', $value->page_title ?? '') }}">
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Açıklama</label>
        <textarea class="form-control" id="exampleFormControlTextarea1"
                  name="page_description"
                  placeholder="Açıklama alanını doldurunuz"
                  rows="5">{{ old('page_description', $value->page_description ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label for="simpleinput">Sayfa Keywords</label>
        <input type="text" id="simpleinput" class="form-control"
               name="page_keywords"
               placeholder="Anahtar kelimeleri virgülle (,) ayırınız"
               value="{{ old('page_keywords', $value->page_keywords ?? '') }}">
    </div>
    <div class="form-group">
        <label for="simpleinput">Sayfa Adresi</label>
        <input type="text" id="simpleinput" class="form-control" name="slug"
               placeholder="Kaydettikten sonra otomatik oluşacak" readonly
               value="{{ old('slug', $value->slug ?? '') }}">
    </div>

</div>
