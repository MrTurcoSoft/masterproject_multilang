<div class="tab-pane fade active show" id="en" role="tabpanel"
     aria-labelledby="en">
    <div class="form-group">
        <label for="title">Slider Başlığı</label>
        <input type="text" id="title" class="form-control" name="title"
               placeholder="Slider Başlığı alanını doldurunuz"
               value="{{ old('title', $value->title ?? '') }}">
    </div>
    <div class="form-group">
        <label for="content">Slider İçeriği 1. satır</label>
        <input type="text" id="content" class="form-control" name="content"
               placeholder="Slider İçeriği alanını doldurunuz"
               value="{{ old('content', $value->content ?? '') }}">
    </div>
    <div class="form-group">
        <label for="content2">Slider İçeriği 2. satır</label>
        <input type="text" id="content2" class="form-control" name="content2"
               placeholder="Slider İçeriği alanını doldurunuz"
               value="{{ old('content2', $value->content2 ?? '') }}">
    </div>
    <div class="form-group">
        <label for="btnText">Buton Text</label>
        <input type="text" id="btnText" class="form-control" name="btnText"
               placeholder="Buton Text alanını doldurunuz"
               value="{{ old('btnText', $value->btnText ?? '') }}">
    </div>
    <div class="form-group">
        <label for="url">Buton URL</label>
        <input type="text" id="url" class="form-control" name="url"
               placeholder="Buton URL alanını doldurunuz"
               value="{{ old('url', $value->url ?? '') }}">
    </div>

</div>
