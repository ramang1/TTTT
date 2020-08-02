@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Inbox
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($inbox, ['route' => ['inboxes.update', $inbox->id], 'method' => 'patch']) !!}

                        @include('inboxes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection