@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thong tin chi tiet thu
                </header>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo $message;
                        Session::put('message',null);
                    }
                    ?>
                    <div class="position-center">
                        @foreach($data as $key => $data)
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thu</label>
                        <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$data -> name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value="{{$data -> type}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                        <textarea style="resize: none" rows="7" class="form-control" name="product_desc" id="exampleInputPassword1" >{{$data -> note}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none" rows="7" class="form-control" name="product_content" id="exampleInputPassword1" >{{$data -> created_at}}</textarea>
                        </div>
                        @endforeach
                </div>
            </section>
</div>
@endsection