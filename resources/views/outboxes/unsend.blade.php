@extends('layouts.app')
@section('content-header')
<section class="content-header">

</section>
@endsection

@section('content')

@include('outboxes.boxUnsend')

@endsection

@push('scripts')
<script src="{{ asset('js/dashboard.js') }}"></script>
@endpush
