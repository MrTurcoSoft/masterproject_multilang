<div class="tab-pane fade" id="sr" role="tabpanel" aria-labelledby="sr">
    <div class="form-group">
        <label for="title_sr">Başlık</label>
        <input type="text" id="title_sr" class="form-control" name="title_sr"
               placeholder="Başlık alanını doldurunuz"
               value="{{ $value->title_sr ?? '' }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="sr" data-field="title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-sr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="description_sr">İçerik</label>
        <textarea id="description_sr" class="tinymce-editor"
                  name="description_sr">{!! $value->description_sr ?? '' !!}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="sr" data-field="description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-sr"></span>
        </button>
    </div>

    <div class="form-group">
        <label for="btnText_sr">Buton Text</label>
        <input type="text" class="form-control"
               name="btnText_sr" value="{{$value->btnText_sr ?? ''}}" required>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="sr" data-field="btnText">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-sr"></span>
        </button>
    </div>


    <div class="form-group">
        <label for="url_sr">Buton URL</label>
        <input type="text" class="form-control" name="url_sr" value="{{$value->url_sr ?? ''}}" required>
        <span
            style="color:red;"><small>Eğer Mail adresi eklenecekse format: mailto:mailadresi@xxx.com şeklinde olmalı</small></span>
    </div>
</div>
