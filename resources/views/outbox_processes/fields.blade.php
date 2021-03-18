<!-- Action Field -->
<div class="form-group col-sm-6">
{!! Form::label('action_type', 'Action Type:') !!}
    {!! Form::select('action_type', ['TRUYEN_MAIL' => 'TRUYEN_MAIL', 'TRUYEN_USB' => 'TRUYEN_USB', 'nen_zip' => 'nen_zip','gui_mai' =>'gui_mai','nen_rar' => 'nen_rar','move_slan' => 'move_slan','send_modem' => 'send_modem'], null, ['class' => 'form-control']) !!}
</div>

<!-- Outbox Hash Field -->
<div class="form-group col-sm-6">
    {!! Form::label('outbox_id', 'Outbox id:') !!}
    {!! Form::text('outbox_id', $id, ['class' => 'form-control', 'readonly' => 'true']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', Auth::id(), ['class' => 'form-control', 'readonly' => 'true']) !!}
</div>

<!-- Note Field -->
<div class="form-group col-sm-6">
    {!! Form::label('note', 'Note:') !!}
    {!! Form::text('note', Auth::user()->name, ['class' => 'form-control', 'readonly' => 'true']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', 'chèn thủ công', ['class' => 'form-control', 'readonly' => 'true']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('outboxProcesses.index') }}" class="btn btn-default">Cancel</a>
</div>
