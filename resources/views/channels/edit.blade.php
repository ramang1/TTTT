@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Channel
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($channel, ['route' => ['channels.update', $channel->id], 'method' => 'patch']) !!}

                        @include('channels.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection