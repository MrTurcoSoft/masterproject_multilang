<div class="tab-pane fade" id="hu" role="tabpanel" aria-labelledby="hu">
    <!-- Başlık Alanı -->
    <div class="form-group">
        <label for="simpleinput">Sertifika/Belge Adı</label>
        <input type="text" id="simpleinput" class="form-control" name="name_hu"
               placeholder="Sertifika/Belge Adı alanını doldurunuz"
               value="{{ old('name_hu') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="hu" data-field="name">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-hu"></span>
        </button>
    </div>
</div>
