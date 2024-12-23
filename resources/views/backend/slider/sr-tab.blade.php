<div class="tab-pane fade" id="sr" role="tabpanel" aria-labelledby="sr">
    <div class="form-group">
        <label for="simpleinput">Slider Başlığı</label>
        <input type="text" id="simpleinput" class="form-control" name="title_sr"
               placeholder="Slider Başlığı alanını doldurunuz"
               value="{{ old('title_sr', $value->title_sr ?? '') }}">
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
        <label for="simpleinput">Slider İçeriği 1.satır</label>
        <input type="text" id="simpleinput" class="form-control" name="content_sr"
               placeholder="Slider İçeriği alanını doldurunuz"
               value="{{ old('content_sr', $value->content_sr ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="sr" data-field="content">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-sr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Slider İçeriği 2.satır</label>
        <input type="text" id="simpleinput" class="form-control" name="content2_sr"
               placeholder="Slider İçeriği alanını doldurunuz"
               value="{{ old('content2_sr', $value->content2_sr ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="sr" data-field="content2">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-sr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Buton Text</label>
        <input type="text" id="simpleinput" class="form-control" name="btnText_sr"
               placeholder="Buton Text alanını doldurunuz"
               value="{{ old('btnText_sr', $value->btnText_sr ?? '') }}">
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
        <label for="simpleinput">Buton URL</label>
        <input type="text" id="simpleinput" class="form-control" name="url_sr"
               placeholder="Buton URL alanını doldurunuz"
               value="{{ old('url_sr', $value->url_sr ?? '') }}">
    </div>
</div>
