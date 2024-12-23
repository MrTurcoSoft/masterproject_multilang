<div class="tab-pane fade" id="it" role="tabpanel" aria-labelledby="it">
    @if($section==1)
        <div class="form-group">
            <label for="title_it">Başlık</label>
            <input type="text" id="title_it" class="form-control" name="title_it" {{$section == 1 ? null : 'disabled'}}
                   placeholder="Başlık alanını doldurunuz"
                   value="{{ $value->title_it ?? '' }}">
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
            <label for="description_it">İçerik</label>
            <textarea id="description_it" class="tinymce-editor" {{$section == 1 ? null : 'disabled'}}
                      name="description_it">{!! $value->description_it ?? '' !!}</textarea>
            <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                    data-lang="it" data-field="description">
                <!-- İlk Bayrak -->
                <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
                <!-- Ok İşareti veya Ayrım -->
                <span style="font-size:16px; margin-right:8px;">→</span>
                <!-- İkinci Bayrak -->
                <span style="font-size:20px;" class="fi fi-it"></span>
            </button>
        </div>

    @endif
    @if($section==2)
        <div class="form-group">
            <label for="title_it">Başlık</label>
            <input type="text" id="title_it" class="form-control" name="title_it" {{$section == 2 ? null : 'disabled'}}
                   placeholder="Başlık alanını doldurunuz"
                   value="{{ $value->title_it ?? '' }}">
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
            <label for="description_it">İçerik</label>
            <textarea id="description_it" class="tinymce-editor" {{$section == 2 ? null : 'disabled'}}
                      name="description_it">{!! $value->description_it ?? '' !!}</textarea>
            <button type="button" class="btn btn-secondary translate-btn d-flex align-items-center"
                    data-lang="it" data-field="description">
                <!-- İlk Bayrak -->
                <span style="font-size:20px; margin-right:8px;" class="fi fi-gb"></span>
                <!-- Ok İşareti veya Ayrım -->
                <span style="font-size:16px; margin-right:8px;">→</span>
                <!-- İkinci Bayrak -->
                <span style="font-size:20px;" class="fi fi-it"></span>
            </button>
        </div>

        <div class="form-group">
            <label for="btnText_it">Buton Text</label>
            <input type="text"  class="form-control" {{$section == 2 ? null : 'disabled'}}
                   name="btnText_it" value="{{$value->btnText_it ?? ''}}" required>
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
            <label for="url_it">Buton URL</label>
            <input type="text" class="form-control" name="url_it" value="{{$value->url_it ?? ''}}" {{$section == 2 ? null : 'disabled'}} required>
            <span style="color:red;"><small>Eğer Mail adresi eklenecekse format: mailto:mailadresi@xxx.com şeklinde olmalı</small></span>
        </div>

    @endif
    @if($section==4)
        <div class="form-group">
            <label for="title_it">Başlık</label>
            <input type="text" id="title_it" class="form-control" name="title_it" {{$section == 4 ? null : 'disabled'}}
                   placeholder="Başlık alanını doldurunuz"
                   value="{{ $value->title_it ?? '' }}">
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
            <label for="btnText_it">Buton Text</label>
            <input type="text"  class="form-control"
                   name="btnText_it" value="{{$value->btnText_it ?? ''}}" {{$section == 4 ? null : 'disabled'}} required>
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
            <label for="url_it">Buton URL</label>
            <input type="text" class="form-control" name="url_it" value="{{$value->url_it ?? ''}}" {{$section == 4 ? null : 'disabled'}} required>
            <span style="color:red;"><small>Eğer Mail adresi eklenecekse format: mailto:mailadresi@xxx.com şeklinde olmalı</small></span>
        </div>

    @endif
</div>
