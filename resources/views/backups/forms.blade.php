@if (Request::get('action') == 'delete' && Request::has('file_name'))
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('Xóa File Sao lưu') }}</h3>
        </div>
        <div class="panel-body">
            <p>{!! trans('Bạn có chắc chắn muốn xóa file sao lưu này?', ['filename' => Request::get('file_name')]) !!}</p>
        </div>
        <div class="panel-footer">
            <a href="{{ route('backups.index') }}" class="btn btn-default">{{ trans('Hủy thao tác') }}</a>
            <form action="{{ route('backups.destroy', Request::get('file_name')) }}" method="post" class="pull-right">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <input type="hidden" name="file_name" value="{{ Request::get('file_name') }}">
                <input type="submit" class="btn btn-danger" value="{{ trans('Xác nhận xóa File') }}">
            </form>
        </div>
    </div>
@endif
@if (Request::get('action') == 'restore' && Request::has('file_name'))
    <div class="panel panel-warning">
        <div class="panel-heading"><h3 class="panel-title">{{ trans('Khôi phục CSDL') }}</h3></div>
        <div class="panel-body">
            <p>{!! trans('Bạn có chắc chắn muốn khôi phục CSDL?', ['filename' => Request::get('file_name')]) !!}</p>
        </div>
        <div class="panel-footer">
            <a href="{{ route('backups.index') }}" class="btn btn-default">{{ trans('Hủy thao tác') }}</a>
            <form action="{{ route('backups.restore', Request::get('file_name')) }}"
                method="post"
                class="pull-right"
                onsubmit="return confirm('Click OK to Restore.')">
                {{ csrf_field() }}
                <input type="hidden" name="file_name" value="{{ Request::get('file_name') }}">
                <input type="submit" class="btn btn-warning" value="{{ trans('Xác nhận khôi phục') }}">
            </form>
        </div>
    </div>
@endif
<div class="panel panel-default">
    <div class="panel-body">
        <form action="{{ route('backups.store') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="file_name" class="control-label">{{ trans('Tạo file Backup') }}</label>
                <input type="text" name="file_name" class="form-control" placeholder="{{ date('Y-m-d_Hi') }}">
                {!! $errors->first('file_name', '<div class="text-danger text-right">:message</div>') !!}
            </div>
            <div class="form-group">
                <input type="submit" value="Sao Lưu" class="btn btn-success">
            </div>
        </form>
        <hr>
        <form action="{{ route('backups.upload') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="backup_file" class="control-label">{{ trans('Khôi phục CSDL từ file Backup') }}</label>
                <input type="file" name="backup_file" class="form-control">
                {!! $errors->first('backup_file', '<div class="text-danger text-right">:message</div>') !!}
            </div>
            <div class="form-group">
                <input type="submit" value="Phục Hồi" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>