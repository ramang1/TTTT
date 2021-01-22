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
<script>
var isPlayAudio = {!!settings('is_play_audio')!!}
var x = setInterval(function() {
    refreshPage();
}, {!!settings('time_refresh')*1000!!});

$(document).ready(function () {

var unRead = $('#totalUnread').text();
if (unRead > 0) {
    
    console.log('co dien den ' + unRead);
    if (isPlayAudio == 1)playAudio();
  
}

})
</script>
@endpush
