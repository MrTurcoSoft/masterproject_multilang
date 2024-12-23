<div class="tab-pane fade active show" id="en" role="tabpanel"
     aria-labelledby="en">
    @if($section==1)
    <div class="form-group">
        <label for="content">Başlık</label>
        <input type="text" id="title" class="form-control" name="title" {{$section == 1 ? null : 'disabled'}}
               placeholder="Başlık alanını doldurunuz"
               value="{{ $value->title ?? '' }}">
    </div>
    <div class="form-group">
        <label for="content2">İçerik</label>
        <textarea id="description" class="tinymce-editor" {{$section == 1 ? null : 'disabled'}}
                  name="description">{!! $value->description ?? '' !!}</textarea>
    </div>
        <div class="form-group">
            <div class="form-check form-switch">
                <input class="form-check-input" type="hidden" name="isActive" value="0" {{$section == 1 ? null : 'disabled'}}>
                <input type="checkbox" data-toggle="switchery" data-color="#38b3d6" data-secondary-color="#df3554" name="isActive" value="1" {{$section == 1 ? null : 'disabled'}}
                    {{  old('isActive', $value->isActive == 1 ) ? 'checked' : '' }}/>
                <label class="form-check-label">Pasif/Aktif</label>
            </div>
        </div>
        <input type="hidden" name="section" value="1">
    @endif

        @if($section==2)
            <div class="form-group">
                <label for="content">Başlık</label>
                <input type="text" id="title" class="form-control" name="title" {{$section == 2 ? null : 'disabled'}}
                       placeholder="Başlık alanını doldurunuz"
                       value="{{ $value->title ?? '' }}">
            </div>
            <div class="form-group">
                <label for="content2">İçerik</label>
                <textarea id="description" class="tinymce-editor" {{$section == 2 ? null : 'disabled'}}
                          name="description">{!! $value->description ?? '' !!}</textarea>
            </div>

                <div class="form-group">
                    <label for="email-id-vertical">Buton Text</label>
                    <input type="text" id="email-id-vertical" class="form-control" {{$section == 2 ? null : 'disabled'}}
                           name="btnText" value="{{$value->btnText ?? ''}}" required>
                </div>


                <div class="form-group">
                    <label for="contact-info-vertical">Buton URL</label>
                    <input type="text" id="contact-info-vertical" class="form-control" {{$section == 2 ? null : 'disabled'}}
                           name="url" value="{{$value->url ?? ''}}" required>
                    <span style="color:red;"><small>Eğer Mail adresi eklenecekse format: mailto:mailadresi@xxx.com şeklinde olmalı</small></span>
                </div>

            <div class="form-group">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="hidden" name="isActive" value="0" {{$section == 2 ? null : 'disabled'}}>
                    <input type="checkbox" data-toggle="switchery" data-color="#38b3d6" data-secondary-color="#df3554" name="isActive" value="1" {{$section == 2 ? null : 'disabled'}}
                        {{  old('isActive', $value->isActive == 1 ) ? 'checked' : '' }}/>
                    <label class="form-check-label">Pasif/Aktif</label>
                </div>
            </div>
        @endif
        @if($section==4)
            <div class="form-group">
                <label for="content">Başlık</label>
                <input type="text" id="title" class="form-control" name="title" {{$section == 4 ? null : 'disabled'}}
                       placeholder="Başlık alanını doldurunuz"
                       value="{{ $value->title ?? '' }}">
            </div>

            <div class="form-group">
                <label for="email-id-vertical">Buton Text</label>
                <input type="text" id="email-id-vertical" class="form-control" {{$section == 4 ? null : 'disabled'}}
                       name="btnText" value="{{$value->btnText ?? ''}}" required>
            </div>


            <div class="form-group">
                <label for="contact-info-vertical">Buton URL</label>
                <input type="text" id="contact-info-vertical" class="form-control" {{$section == 4 ? null : 'disabled'}}
                       name="url" value="{{$value->url ?? ''}}" required>
                <span style="color:red;"><small>Eğer Mail adresi eklenecekse format: mailto:mailadresi@xxx.com şeklinde olmalı</small></span>
            </div>

            <div class="form-group">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="hidden" name="isActive" value="0" {{ $section == 4 ? null : 'disabled'}}>
                    <input type="checkbox" data-toggle="switchery" data-color="#38b3d6" data-secondary-color="#df3554" name="isActive" value="1" {{$section == 4 ? null : 'disabled'}}
                        {{  old('isActive', $value->isActive == 1 ) ? 'checked' : '' }}/>
                    <label class="form-check-label">Pasif/Aktif</label>
                </div>
            </div>
        @endif


</div>
