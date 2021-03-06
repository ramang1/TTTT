@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left">Settings</h1>

</section>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            <!-- Field settings -->
            {!! Form::open(['url' => 'settings/update', 'method' => 'GET']) !!}

            @include('settings.fields')

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection