<div class="tab-pane fade" id="de" role="tabpanel" aria-labelledby="de">
    <div class="form-group">
        <label for="title_de">Başlık</label>
        <input type="text" id="title_de" class="form-control" name="title_de"
        placeholder="Başlık alanını doldurunuz"
               value="{{ $value->title_de ?? '' }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="de" data-field="title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-de"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="description_de">İçerik</label>
        <textarea id="description_de" class="tinymce-editor"
        name="description_de">{!! $value->description_de ?? '' !!}</textarea>
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

    <div class="form-group">
        <label for="btnText_de">Buton Text</label>
        <input type="text" class="form-control"
        name="btnText_de" value="{{ $value->btnText_de ?? ''}}" required>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="de" data-field="btnText">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-de"></span>
        </button>
    </div>


    <div class="form-group">
        <label for="url_de">Buton URL</label>
        <input type="text" class="form-control" name="url_de" value="{{$value->url_de ?? ''}}"
               required>
        <span
            style="color:red;"><small>Eğer Mail adresi eklenecekse format: mailto:mailadresi@xxx.com şeklinde olmalı</small></span>
    </div>
</div>
