<div class="tab-pane fade active show" id="en" role="tabpanel"
     aria-labelledby="en">
    <div class="form-group">
        <label for="content">Başlık</label>
        <input type="text" id="title" class="form-control" name="title"
        placeholder="Başlık alanını doldurunuz"
               value="{{ $value->title ?? '' }}">
    </div>
    <div class="form-group">
        <label for="content2">İçerik</label>
        <textarea id="description" class="tinymce-editor"
        name="description">{!! $value->description ?? '' !!}</textarea>
    </div>

    <div class="form-group">
        <label for="email-id-vertical">Buton Text</label>
        <input type="text" id="email-id-vertical" class="form-control"
        name="btnText" value="{{$value->btnText ?? ''}}" required>
    </div>


    <div class="form-group">
        <label for="contact-info-vertical">Buton URL</label>
        <input type="text" id="contact-info-vertical" class="form-control"
        name="url" value="{{$value->url ?? ''}}" required>
        <span
            style="color:red;"><small>Eğer Mail adresi eklenecekse format: mailto:mailadresi@xxx.com şeklinde olmalı</small></span>
    </div>
</div>
