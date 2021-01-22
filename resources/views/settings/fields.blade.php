<!-- site_name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('site_name', 'Tên đơn vị sử dụng:') !!}
    {!! Form::text('site_name', $settings->get('site_name', 'TTTT'), ['class' => 'form-control']) !!}
</div>

<!-- time_refresh Field -->
<div class="form-group col-sm-12">
    {!! Form::label('time_refresh', 'Thời gian (giây) reload trang web:') !!}
    <input class="form-control" name="time_refresh" type="number" value="{!!$settings->get('time_refresh', '10')!!}" id="time_refresh" min="1" max="300">
</div>

<div class="form-group col-sm-12">
    {!! Form::checkbox('is_play_audio', '1', $settings->get('is_play_audio') == 1?true:false) !!}
    {!! Form::label('is_play_audio', 'Phát âm thanh khi có điện đến') !!}
    </label>
</div>

<div class="form-group col-sm-12">
    <label>Âm thanh</label>
    <select name = "audio_file" class="form-control">
        <option>{!! $settings->get('audio_file', 'Chọn file')!!}</option>
        @foreach ($audios as $audio)
        <option>{!! $audio!!}</option>
        @endforeach

    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

</div>