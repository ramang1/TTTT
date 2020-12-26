@extends('layouts.app')
@section('content-header')
<section class="content-header">
  
 
</section>
@endsection

@section('content')

{{-- Box content --}}
 <!-- Main content -->
<div class="content">
@include('dashboard.box')


@include('dashboard.card')
</div>
@endsection


@push('scripts')
<script src="{{ asset('js/dashboard.js') }}"></script>

@endpush
