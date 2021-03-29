@extends('layouts.app')

@section('title',trans('backup.index_title'))

@section('content')
<div class="content">
<h1 class="page-header"><b>SAO LƯU VÀ PHỤC HỒI CƠ SỞ DỮ LIỆU</b></h1>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><b>Danh sách các bản sao lưu</b></h3></div>
            <table class="table table-condensed">
                <thead>
                    <th>STT</th>
                    <th>Tên bản sao lưu</th>
                    <th>Kích cỡ</th>
                    <th>Ngày</th>
                    <th class="text-center">Actions</th>
                </thead>
                <tbody>
                    @forelse($backups as $key => $backup)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $backup->getFilename() }}</td>
                        <td>{{ ($backup->getSize()) }}</td>
                        <td>{{ date('Y-m-d H:i:s', $backup->getMTime()) }}</td>
                        <td class="text-center">
                            <a href="{{ route('backups.index', ['action' => 'restore', 'file_name' => $backup->getFilename()]) }}"
                                id="restore_{{ str_replace('.gz', '', $backup->getFilename()) }}"
                                class="btn btn-warning btn-xs"
                                title="{{ trans('Khôi phục tại thời điểm này') }}"><i class="fa fa-rotate-left"></i></a>
                            <a href="{{ route('backups.download', [$backup->getFilename()]) }}"
                                id="download_{{ str_replace('.gz', '', $backup->getFilename()) }}"
                                class="btn btn-info btn-xs"
                                title="{{ trans('Tải về bản sao lưu') }}"><i class="fa fa-download"></i></a>
                            <a href="{{ route('backups.index', ['action' => 'delete', 'file_name' => $backup->getFilename()]) }}"
                                id="del_{{ str_replace('.gz', '', $backup->getFilename()) }}"
                                class="btn btn-danger btn-xs"
                                title="{{ trans('Xóa bản sao lưu') }}"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">{{ trans('Chưa có File Backup') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        @include('backups.forms')
    </div>
</div>
</div>
@endsection
