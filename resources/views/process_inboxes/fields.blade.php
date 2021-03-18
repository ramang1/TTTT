<!-- Process Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('action_type', 'Action Type:') !!}
    {!! Form::select('action_type', ['DICH_KN' => 'DICH_KN', 'DICH_KT_KS' => 'DICH_KT_KS', 'DICH_KT_ST' => 'DICH_KT_ST'], null, ['class' => 'form-control']) !!}
</div>

<!-- Inbox Hash Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inboxes_id', 'Inbox ID:') !!}
    {!! Form::text('inboxes_id', $id, ['class' => 'form-control', 'readonly' => 'true']) !!}
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
    <a href="{{ route('processInboxes.index') }}" class="btn btn-default">Cancel</a>
</div>
