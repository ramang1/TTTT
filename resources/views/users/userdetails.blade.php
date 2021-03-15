@extends('layouts.app')
{{-- @section('title',trans('backup.index_title')) --}}
@section('content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <b>Thông tin Tài Khoản</b>
                </header>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo $message;
                        Session::put('message',null);
                    }
                    ?>
                    <p></p>
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-userdetails/'.Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên tài khoản</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{ Auth::user()->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Emails</label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1" value="{{ Auth::user()->email }}" readonly>
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Tên đơn vị</label>
                            <input type="text" name="" class="form-control" id="exampleInputEmail1" value="{{ Auth::user()->email }}">
                        </div> --}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ảnh tài khoản</label>
                            <img src="uploads/users/{{Auth::user()->id}}.png" width="400" height="300"/>
                            <input type="file" name="picture" class="form-control" id="exampleInputEmail1" >
                        {{-- <img src="{{URL::to('uploads/product/'.$pro->product_image)}}" width="150" height="160"> --}}
                        </div>
                        <button type="submit" name='update_userdetails' class="btn btn-info">Cập nhập</button>
                    </form>
                    </div>
                </div>
            </section>
</div>
@endsection