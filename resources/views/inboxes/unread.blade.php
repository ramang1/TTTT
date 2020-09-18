@extends('layouts.app')
@section('content-header')
<section class="content-header">

</section>
@endsection

@section('content')

@include('inboxes.boxUnread')

@endsection


@push('scripts')
<script src="{{ asset('js/dashboard.js') }}"></script>
 <!-- <script src="{{ asset('js/date_ranger.js') }}"></script> -->
@endpush
