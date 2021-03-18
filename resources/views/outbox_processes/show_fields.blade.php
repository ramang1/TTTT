
<!-- Action Field -->
<div class="form-group">
    {!! Form::label('action_type', 'Action Type:') !!}
    <p>{{ $outboxProcess->action_type }}</p>
</div>

<!-- Outbox Hash Field -->
<div class="form-group">
    {!! Form::label('outbox_id', 'Outbox ID:') !!}
    <p>{{ $outboxProcess->outbox_id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $outboxProcess->user_id }}</p>
</div>

<!-- Note Field -->
<div class="form-group">
    {!! Form::label('note', 'Note:') !!}
    <p>{{ $outboxProcess->note }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $outboxProcess->description }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $outboxProcess->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $outboxProcess->updated_at }}</p>
</div>

