<div class="tab-pane fade" id="es" role="tabpanel" aria-labelledby="es">
    <div class="form-group">
        <label for="simpleinput">Slider Başlığı</label>
        <input type="text" id="simpleinput" class="form-control" name="title_es"
               placeholder="Slider Başlığı alanını doldurunuz"
               value="{{ old('title_es', $value->title_es ?? '') }}">
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
        <label for="simpleinput">Slider İçeriği 1.satır</label>
        <input type="text" id="simpleinput" class="form-control" name="content_es"
               placeholder="Slider İçeriği alanını doldurunuz"
               value="{{ old('content_es', $value->content_es ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="es" data-field="content">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-es"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Slider İçeriği 2.satır</label>
        <input type="text" id="simpleinput" class="form-control" name="content2_es"
               placeholder="Slider İçeriği alanını doldurunuz"
               value="{{ old('content2_es', $value->content2_es ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="es" data-field="content2">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-es"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Buton Text</label>
        <input type="text" id="simpleinput" class="form-control" name="btnText_es"
               placeholder="Buton Text alanını doldurunuz"
               value="{{ old('btnText_es', $value->btnText_es ?? '') }}">
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
        <label for="simpleinput">Buton URL</label>
        <input type="text" id="simpleinput" class="form-control" name="url_es"
               placeholder="Buton URL alanını doldurunuz"
               value="{{ old('url_es', $value->url_es ?? '') }}">
    </div>
</div>
