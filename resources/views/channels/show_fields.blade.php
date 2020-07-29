<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $channel->id }}</p>
</div>

<!-- Code Field -->
<div class="form-group">
    {!! Form::label('code', 'Code:') !!}
    <p>{{ $channel->code }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $channel->name }}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $channel->type }}</p>
</div>

<!-- MANY ONE -->
<div class="form-group">
    {!! Form::label('contats', 'Number of Contacts:') !!}
    <p>{{count($contacts)}}</p>
</div>

<!-- List contact -->
<div class="form-group">
    {!! Form::label('contact', 'Contacts:') !!}
    @foreach ($contacts as $contact)
        <p>{{$contact->name}} ({{$contact->code}})</p>    
    @endforeach
</div>
<!-- Note Field -->
<div class="form-group">
    {!! Form::label('note', 'Note:') !!}
    <p>{{ $channel->note }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $channel->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $channel->updated_at }}</p>
</div>

