<!-- Process Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('action', 'Process Type:') !!}
    {!! Form::text('action', null, ['class' => 'form-control']) !!}
</div>

<!-- Inbox Hash Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inbox_id', 'Inbox Hash:') !!}
    {!! Form::text('inbox_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Note Field -->
<div class="form-group col-sm-6">
    {!! Form::label('note', 'Note:') !!}
    {!! Form::text('note', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('processInboxes.index') }}" class="btn btn-default">Cancel</a>
</div>
