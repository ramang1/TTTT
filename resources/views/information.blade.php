@extends('layouts.app')

{{-- @section('title',trans('backup.index_title')) --}}

@section('content')

    <div class="container">
        <h2 class="text-center">Giới thiệu về tác giả</h2>

        <div class="image">
            <img class="img-responsive img-circle" src="{{asset('/uploads/information/information.png')}}" width="400" height="600" alt="Author Picture"/>
        </div>
        <div class="item">
            <h3>Cục QLKTNVMM</h3>

            <p class="lead">
                Được xây dựng và phát triển bởi Cục QLKTNVMM</p>
                <p>Thành viên bao gồm : </p>
                <p>Đỗ Văn Thùy</p>

                <p>Phạm Tăng Phú</p>

                <p>Nguyễn Tuấn Anh</p>



        </div>
    </div>
    <!-- /.container -->

@endsection
