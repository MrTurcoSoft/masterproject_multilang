<div class="tab-pane fade" id="de" role="tabpanel" aria-labelledby="de">
    <div class="form-group">
        <label for="simpleinput">Slider Başlığı</label>
        <input type="text" id="simpleinput" class="form-control" name="title_de"
               placeholder="Slider Başlığı alanını doldurunuz"
               value="{{ old('title_de', $value->title_de ?? '') }}">
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
        <label for="simpleinput">Slider İçeriği 1.satır</label>
        <input type="text" id="simpleinput" class="form-control" name="content_de"
               placeholder="Slider İçeriği alanını doldurunuz"
               value="{{ old('content_de', $value->content_de ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="de" data-field="content">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-de"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Slider İçeriği 2.satır</label>
        <input type="text" id="simpleinput" class="form-control" name="content2_de"
               placeholder="Slider İçeriği alanını doldurunuz"
               value="{{ old('content2_de', $value->content2_de ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="de" data-field="content2">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-de"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Buton Text</label>
        <input type="text" id="simpleinput" class="form-control" name="btnText_de"
               placeholder="Buton Text alanını doldurunuz"
               value="{{ old('btnText_de', $value->btnText_de ?? '') }}">
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
        <label for="simpleinput">Buton URL</label>
        <input type="text" id="simpleinput" class="form-control" name="url_de"
               placeholder="Buton URL alanını doldurunuz"
               value="{{ old('url_de', $value->url_de ?? '') }}">
    </div>
</div>
