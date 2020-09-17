<div class="col-md-20">
      <!-- MAP & BOX PANE -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title" style="font-weight: bold;">Thư chưa gửi</h3>

          <!-- <div class="box-tools pull-right">
            <div class="has-feedback">
              <input type="text" class="form-control input-sm" placeholder="Search Mail">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
          </div> -->
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <!-- /.btn-group -->
            <!-- <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
            <div class="pull-right">
              1-50/200
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
              </div> -->
              <!-- /.btn-group -->
            </div>
            <!-- /.pull-right -->
          </div>
          <div class="table-responsive mailbox-messagess">
            <!-- <table class="table table-hover table-stripedd" id="users-table" > -->
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                    <th>Tên thư chưa gửi</th>
                    <th>ID</th>
                    <th>Đường dẫn</th>
                    <th>Kích thước</th>
                    <th>Kiểu nén</th>\
                    <th>ID của nhóm nhận</th>
                    <th>Thời gian</th>
                    </tr>
                </thead>
              </tbody>
            </table>

            @push('scripts')
                <script>
                    $(function() {
                        $('#users-table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '{!!route('users.unsenddata')!!}',
                            columns: [
                                { data: 'name', name: 'name' },
                                { data: 'id', name: 'id' },
                                { data: 'path', name: 'path' },
                                { data: 'size', name: 'size' },
                                { data: 'type', name: 'type' },
                                { data: 'channel_id', name: 'channel_id' },
                                { data: 'created_at', name: 'created_at' }
                            ]
                        });
                    });
                </script>
            @endpush
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <!-- /.box-body -->
        <!-- <div class="box-footer no-padding"> -->
          <!-- <div class="mailbox-controls"> -->
            <!-- Check all button -->
            <!-- <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
              <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
            </div> -->
            <!-- /.btn-group -->
            <!-- <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button> -->
            <!-- <div class="pull-right">
              1-50/200
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
              </div> -->
              <!-- /.btn-group -->
            </div>
            <!-- /.pull-right -->
          </div>
        </div>
      </div>

    </div>
