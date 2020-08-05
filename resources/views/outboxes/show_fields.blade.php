<!-- Has Field -->
<div class="form-group">
    {!! Form::label('hash', 'Hash:') !!}
    <p>{{ $outbox->has }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $outbox->name }}</p>
</div>

<!-- Path Field -->
<div class="form-group">
    {!! Form::label('path', 'Path:') !!}
    <p>{{ $outbox->path }}</p>
</div>

<!-- Size Field -->
<div class="form-group">
    {!! Form::label('size', 'Size:') !!}
    <p>{{ $outbox->size }}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $outbox->type }}</p>
</div>

<!-- Contact Id Field -->
<div class="form-group">
    {!! Form::label('contact_id', 'Contact Id:') !!}
    <p>{{ $outbox->contact_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $outbox->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $outbox->updated_at }}</p>
</div>

