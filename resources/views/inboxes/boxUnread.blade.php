<div class="col-md-20">
      <!-- MAP & BOX PANE -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title" style="font-weight: bold;">Thư chưa đọc</h3>

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
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped" id="phu-table" >
              <tbody>
                </tbody><thead>
                    <tr>
                    <!-- <th style="width:10px;">
                    <label class="i-checks m-b-none">
                    <input type="checkbox"><i></i>
                    </label> 
                    </th> -->
                    <th>Tên thư chưa đọc</th>
                    <th>Nơi gửi</th>
                    <th>Kích thước</th>
                    <th>Nơi lưu</th>
                    <th>Thời gian</th>
                    </tr>
                </thead>
                <!-- @foreach($totalUnread_inbox as $key => $totalUnread_inbox_content) -->
<!-- <tr>
    <td><div class="icheckbox_flat-blue"  aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></td>
    <td class="mailbox-name"style = "background:Tomato;"><a href="read-mail.html" style = "color: #FFFFFF;">{{$totalUnread_inbox_content->name}}</a></td>
    <td class="mailbox-star" style = ";background:Tomato;color: #FFFFFF;text-align: left">{{$totalUnread_inbox_content->contact_id}}</i></a></td>
    <td class="mailbox-subject" style = "background:Tomato;color: #FFFFFF;">{{$totalUnread_inbox_content->size}}</td>
    <td class="mailbox-attachment" style = "background:Tomato;color: #FFFFFF;">{{$totalUnread_inbox_content->path}}</td>
    <td class="mailbox-date"  style = "background:Tomato;color: #FFFFFF;">{{$totalUnread_inbox_content->created_at}}</td>
  </tr> -->
<!-- @endforeach -->
              </tbody>
            </table>
            @push('scripts')
            <script>
                $(function() {
                    $('#phu-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('users.anydata') !!}',
                        columns: [
                            { data: 'name', name: 'name' },
                            { data: 'contact_id', name: 'contact_id' },
                            { data: 'size', name: 'size' },
                            { data: 'path', name: 'path' },
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
