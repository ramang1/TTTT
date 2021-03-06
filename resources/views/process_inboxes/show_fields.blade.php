<!-- Id Field -->

<!-- Process Type Field -->
<div class="form-group">
    {!! Form::label('action_type', 'Process Type:') !!}
    <p>{{ $processInbox->action_type }}</p>
</div>

<!-- Inbox Hash Field -->
<div class="form-group">
    {!! Form::label('inbox_id', 'Inbox id:') !!}
    <p>{{ $processInbox->inboxes_id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $processInbox->user_id }}</p>
</div>

<!-- Note Field -->
<div class="form-group">
    {!! Form::label('note', 'Note:') !!}
    <p>{{ $processInbox->note }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $processInbox->description }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $processInbox->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $processInbox->updated_at }}</p>
</div>

