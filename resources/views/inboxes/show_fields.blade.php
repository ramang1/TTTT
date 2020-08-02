<!-- Hash Field -->
<div class="form-group">
    {!! Form::label('hash', 'Hash:') !!}
    <p>{{ $inbox->hash }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $inbox->name }}</p>
</div>

<!-- Path Field -->
<div class="form-group">
    {!! Form::label('path', 'Path:') !!}
    <p>{{ $inbox->path }}</p>
</div>

<!-- Size Field -->
<div class="form-group">
    {!! Form::label('size', 'Size:') !!}
    <p>{{ $inbox->size }}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $inbox->type }}</p>
</div>

<!-- Contact Id Field -->
<div class="form-group">
    {!! Form::label('contact_id', 'Contact Id:') !!}
    <p>{{ $inbox->contact_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $inbox->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $inbox->updated_at }}</p>
</div>

