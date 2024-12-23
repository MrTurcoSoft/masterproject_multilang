<div class="tab-pane fade" id="es" role="tabpanel" aria-labelledby="es">
    <div class="form-group">
        <label for="title_es">Başlık</label>
        <input type="text" id="title_es" class="form-control" name="title_es"
        placeholder="Başlık alanını doldurunuz"
               value="{{ $value->title_es ?? '' }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="es" data-field="title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-es"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="description_es">İçerik</label>
        <textarea id="description_es" class="tinymce-editor"
        name="description_es">{!! $value->description_es ?? '' !!}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="es" data-field="description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-es"></span>
        </button>
    </div>

    <div class="form-group">
        <label for="btnText_es">Buton Text</label>
        <input type="text" class="form-control"
        name="btnText_es" value="{{$value->btnText_es ?? ''}}" required>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="es" data-field="btnText">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-es"></span>
        </button>
    </div>


    <div class="form-group">
        <label for="url_es">Buton URL</label>
        <input type="text" class="form-control" name="url_es" value="{{$value->url_es ?? ''}}"
              required>
        <span
            style="color:red;"><small>Eğer Mail adresi eklenecekse format: mailto:mailadresi@xxx.com şeklinde olmalı</small></span>
    </div>
</div>
