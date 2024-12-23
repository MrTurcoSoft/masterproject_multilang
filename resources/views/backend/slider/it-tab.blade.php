<div class="tab-pane fade" id="it" role="tabpanel" aria-labelledby="it">
    <div class="form-group">
        <label for="simpleinput">Slider Başlığı</label>
        <input type="text" id="simpleinput" class="form-control" name="title_it"
               placeholder="Slider Başlığı alanını doldurunuz"
               value="{{ old('title_it', $value->title_it ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="it" data-field="title">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-it"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Slider İçeriği 1.satır</label>
        <input type="text" id="simpleinput" class="form-control" name="content_it"
               placeholder="Slider İçeriği alanını doldurunuz"
               value="{{ old('content_it', $value->content_it ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="it" data-field="content">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-it"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Slider İçeriği 2.satır</label>
        <input type="text" id="simpleinput" class="form-control" name="content2_it"
               placeholder="Slider İçeriği alanını doldurunuz"
               value="{{ old('content2_it', $value->content2_it ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="it" data-field="content2">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-it"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Buton Text</label>
        <input type="text" id="simpleinput" class="form-control" name="btnText_it"
               placeholder="Buton Text alanını doldurunuz"
               value="{{ old('btnText_it', $value->btnText_it ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="it" data-field="btnText">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-it"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Buton URL</label>
        <input type="text" id="simpleinput" class="form-control" name="url_it"
               placeholder="Buton URL alanını doldurunuz"
               value="{{ old('url_it', $value->url_it ?? '') }}">
    </div>
</div>
