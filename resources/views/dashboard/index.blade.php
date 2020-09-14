@extends('layouts.app')
@section('content-header')
<section class="content-header">
  <h1>
    Hiển thị trang chính
    <small>Điều khiển</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
    <li class="active">Hiển thị</li>
  </ol>
</section>
@endsection

@section('content')

{{-- Box content --}}

@include('dashboard.box')
@include('dashboard.card');



@endsection


@push('scripts')
<script src="{{ asset('js/dashboard.js') }}"></script>

@endpush
