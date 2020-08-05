@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Outbox Process
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($outboxProcess, ['route' => ['outboxProcesses.update', $outboxProcess->id], 'method' => 'patch']) !!}

                        @include('outbox_processes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection