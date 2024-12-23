<div class="tab-pane fade" id="fr" role="tabpanel" aria-labelledby="fr">
    <div class="form-group">
        <label for="title_fr">Başlık</label>
        <input type="text" id="title_fr" class="form-control" name="title_fr"
        placeholder="Başlık alanını doldurunuz"
               value="{{ $value->title_fr ?? '' }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="fr" data-field="title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-fr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="description_fr">İçerik</label>
        <textarea id="description_fr" class="tinymce-editor"
        name="description_fr">{!! $value->description_fr ?? '' !!}</textarea>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="fr" data-field="description">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-fr"></span>
        </button>
    </div>

    <div class="form-group">
        <label for="btnText_fr">Buton Text</label>
        <input type="text" class="form-control"
        name="btnText_fr" value="{{$value->btnText_fr ?? ''}}" required>
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="fr" data-field="btnText">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-fr"></span>
        </button>
    </div>


    <div class="form-group">
        <label for="url_fr">Buton URL</label>
        <input type="text" class="form-control" name="url_fr" value="{{$value->url_fr ?? ''}}"
                required>
        <span
            style="color:red;"><small>Eğer Mail adresi eklenecekse format: mailto:mailadresi@xxx.com şeklinde olmalı</small></span>
    </div>
</div>
