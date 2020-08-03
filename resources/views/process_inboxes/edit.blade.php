@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Process Inbox
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($processInbox, ['route' => ['processInboxes.update', $processInbox->id], 'method' => 'patch']) !!}

                        @include('process_inboxes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection