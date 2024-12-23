<div class="tab-pane fade" id="fr" role="tabpanel" aria-labelledby="fr">

    <div class="form-group">
        <label for="simpleinput">Slider Başlığı</label>
        <input type="text" id="simpleinput" class="form-control" name="title_fr"
               placeholder="Slider Başlığı alanını doldurunuz"
               value="{{ old('title_fr', $value->title_fr ?? '') }}">
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
        <label for="simpleinput">Slider İçeriği 1.satır</label>
        <input type="text" id="simpleinput" class="form-control" name="content_fr"
               placeholder="Slider İçeriği alanını doldurunuz"
               value="{{ old('content_fr', $value->content_fr ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="fr" data-field="content">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-fr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Slider İçeriği 2.satır</label>
        <input type="text" id="simpleinput" class="form-control" name="content2_fr"
               placeholder="Slider İçeriği alanını doldurunuz"
               value="{{ old('content2_fr', $value->content2_fr ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="fr" data-field="content2">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-fr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Buton Text</label>
        <input type="text" id="simpleinput" class="form-control" name="btnText_fr"
               placeholder="Buton Text alanını doldurunuz"
               value="{{ old('btnText_fr', $value->btnText_fr ?? '') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="fr" data-field="btnText">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-fr"></span>
        </button>
    </div>
    <div class="form-group">
        <label for="simpleinput">Buton URL</label>
        <input type="text" id="simpleinput" class="form-control" name="url_fr"
               placeholder="Buton URL alanını doldurunuz"
               value="{{ old('url_fr', $value->url_fr ?? '') }}">
    </div>
</div>
