<div class="tab-pane fade" id="it" role="tabpanel" aria-labelledby="it">
    <!-- Başlık Alanı -->
    <div class="form-group">
        <label for="simpleinput">Sertifika/Belge Adı</label>
        <input type="text" id="simpleinput" class="form-control" name="name_it"
               placeholder="Sertifika/Belge Adı alanını doldurunuz"
               value="{{ old('name_it') }}">
        <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                data-lang="it" data-field="name">
            <!-- İlk Bayrak -->
            <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
            <!-- Ok İşareti veya Ayrım -->
            <span style="font-size:16px; margin-right:8px;">→</span>
            <!-- İkinci Bayrak -->
            <span style="font-size:20px;" class="fi fi-it"></span>
        </button>
    </div>
</div>
