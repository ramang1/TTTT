<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-12 col-lg-12">
{!!Form::label('type', 'Channel Type:') !!}
<br>
@foreach($types as $type)
<input type = "radio" id = {{$type}} name = "type" value = {{$type}}>
<label for = "{{$type}}">{{$type}}</label><br>
@endforeach

</div>
<!-- Contact Field -->
<div class="form-group col-sm-12 col-lg-12">

    {!! Form::label('note', 'List contact:') !!}
    <br>
    @foreach($contacts as $contact)
   
<input type="checkbox" id = {{$contact->code}} name="contacts[]" value="{{$contact->code}}"> 
<label for = "{{$contact->code}}">{{$contact->name}} ({{$contact->code}})</label><br>
    @endforeach
  
</div>

<!-- Note Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('note', 'Note:') !!}
    {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('channels.index') }}" class="btn btn-default">Cancel</a>
</div>
