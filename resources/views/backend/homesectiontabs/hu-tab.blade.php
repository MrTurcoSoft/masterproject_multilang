<div class="tab-pane fade" id="hu" role="tabpanel" aria-labelledby="hu">
    <div class="form-group">
        <label for="title_hu">Başlık</label>
        <input type="text" id="title_hu" class="form-control" name="title_hu"
        placeholder="Başlık alanını doldurunuz"
               value="{{ $value->title_hu ?? '' }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="hu" data-field="title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-hu"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="description_hu">İçerik</label>
        <textarea id="description_hu" class="tinymce-editor"
        name="description_hu">{!! $value->description_hu ?? '' !!}</textarea>
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

    <div class="form-group">
        <label for="btnText_hu">Buton Text</label>
        <input type="text" class="form-control"
        name="btnText_hu" value="{{$value->btnText_hu ?? ''}}" required>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="hu" data-field="btnText">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-hu"></span>
        </button>
    </div>


    <div class="form-group">
        <label for="url_hu">Buton URL</label>
        <input type="text" class="form-control" name="url_hu" value="{{$value->url_hu ?? ''}}"
                required>
        <span
            style="color:red;"><small>Eğer Mail adresi eklenecekse format: mailto:mailadresi@xxx.com şeklinde olmalı</small></span>
    </div>
</div>
