<div class="box-header with-border">
    <h3 class="box-title" style="font-weight: bold;">Tổng thư đến</h3>
</div>
<div class="nav-tabs-horizontal">
    <ul class="nav nav-tabs" data-plugin="nav-tabs" role="tablist">
    <!-- <ul class="nav nav-pills" data-plugin="nav-tabs" role="tablist"> -->
       <!-- /.tab1 -->
      <li class="active"
          role="presentation">
          <a id="tab0"
             data-toggle="tab"
             href="#Tab1"
             aria-controls="Tab1"
             role="tab">Tất cả thư
          </a>
      </li>
       <!-- /.end tab1 -->

         <!-- /tab2 -->
      <li role="presentation">
          <a id="tab1"
             data-parent="tab1"
             data-toggle="tab"
             href="#Tab2"
             aria-controls="Tab2"
             role="tab">Thư theo ngày
      </a>
      </li>
       <!-- /end tab2 -->

       <!-- /tab3 -->
      <li role="presentation">
          <a id="tab2"
             data-parent="tab2"
             data-toggle="tab"
             href="#Tab3"
             aria-controls="Tab3"
             role="tab">Thư theo tuần
      </a>
      </li>
        <!-- /end tab3 -->

        <!-- /tab4 -->
      <li role="presentation">
          <a id="tab3"
             data-parent="tab3"
             data-toggle="tab"
             href="#Tab4"
             aria-controls="Tab4"
             role="tab">Thư theo tháng
      </a></li>
        <!-- /end tab4 -->

        <!-- /tab5 -->
      <li role="presentation">
          <a id="tab4"
             data-parent="tab4"
             data-toggle="tab"
             href="#Tab5"
             aria-controls="Tab5"
             role="tab">Thư theo năm
      </a></li>
        <!-- /end tab5 -->

        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Tùy chọn 1</a>
      <a class="dropdown-item" href="#">Tùy chọn 2</a>
      <a class="dropdown-item" href="#">Làm cái gì đó</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Hành động</a>
    </div>
  </li>

    </ul>

    <div class="tab-content padding-top-20">
    <br>
            <div class="tab-pane active" id="Tab1" role="tabpanel">
                    <div class="col-md-20">
                        <!-- MAP & BOX PANE -->
                        <div class="box box-primary">
                            <div class="table-responsive mailbox-messages"  >
                                <table class="table table-hover table-bordered" id="inbox-table1" href="{{asset('public/backend/css/jquery.dataTables.css')}}">
                                <!-- <table class="table table-hover table-bordered" id="phu-table" href={{URL::to('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css')}}> -->
                                    <tbody>
                                    </tbody><thead>
                                        <tr>
                                        <th>Tên thư đến</th>
                                        <th>Mã nơi gửi</th>
                                        <th>Kích thước</th>
                                        <th>Nơi lưu</th>
                                        <th>Kiểu nhận về</th>
                                        <th>ID người nhận</th>
                                        <th>Thời gian</th>
                                        </tr>
                                    </thead>
                                    </tbody>
                                </table>
                                    @push('scripts')
                                        <script>
                                            $(function inboxTab1() {

                                                var tabletotalInbox1 = $('#inbox-table1').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: '{!! route('users.getdatainboxTotal') !!}',
                                                    columns: [
                                                        { data: 'name', name: 'name' },
                                                        { data: 'contact_id', name: 'contact_id' },
                                                        { data: 'size', name: 'size' },
                                                        { data: 'path', name: 'path' },
                                                        { data: 'type', name: 'type' },
                                                        { data: 'user_id', name: 'user_id' },
                                                        { data: 'created_at', name: 'created_at' }
                                                    ]
                                                });
                                                setInterval(function() {
                                                tabletotalInbox1.ajax.reload();
                                                }, 120000 );
                                            });
                                        </script>
                                    @endpush
                            <!-- /.class="table-responsive mailbox-messages" -->
                            </div>

                            <!-- /.class="box box-primary -->
                        </div>

                <!-- /.class="col-md-20"" -->
                </div>

                <!-- /end div class="tab-pane active" id="exampleTabsOne"-->
            </div>


            <!--open second tab-->
            <div class="tab-pane active" id="Tab2" role="tabpanel">
            <div class="col-md-20">
                        <!-- MAP & BOX PANE -->
                        <div class="box box-primary">
                            <div class="table-responsive mailbox-messages"  >
                                <table class="table table-hover table-bordered" id="inbox-table2" href="{{asset('public/backend/css/jquery.dataTables.css')}}">
                                <!-- <table class="table table-hover table-bordered" id="phu-table" href={{URL::to('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css')}}> -->
                                    <tbody>
                                    </tbody><thead>
                                        <tr>
                                        <th>Tên thư đến</th>
                                        <th>Mã nơi gửi</th>
                                        <th>Kích thước</th>
                                        <th>Nơi lưu</th>
                                        <th>Kiểu nhận về</th>
                                        <th>ID người nhận</th>
                                        <th>Thời gian</th>
                                        </tr>
                                    </thead>
                                    </tbody>
                                </table>
                                    @push('scripts')
                                        <script>
                                            $(function inboxTab1() {

                                                var tabletotalInboxTab2 = $('#inbox-table2').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: '{!! route('users.getdatainboxTotal1') !!}',
                                                    columns: [
                                                        { data: 'name', name: 'name' },
                                                        { data: 'contact_id', name: 'contact_id' },
                                                        { data: 'size', name: 'size' },
                                                        { data: 'path', name: 'path' },
                                                        { data: 'type', name: 'type' },
                                                        { data: 'user_id', name: 'user_id' },
                                                        { data: 'created_at', name: 'created_at' }
                                                    ]
                                                });
                                                setInterval(function() {
                                                    tabletotalInboxTab2.ajax.reload();
                                                }, 120000 );
                                            });
                                        </script>
                                    @endpush
                            <!-- /.class="table-responsive mailbox-messages" -->
                            </div>

                            <!-- /.class="box box-primary -->
                        </div>

                <!-- /.class="col-md-20"" -->
                </div>
            <!--close second tab-->
            </div>

             <!--open tab 3-->
             <div class="tab-pane active" id="Tab3" role="tabpanel">
             <div class="col-md-20">
                        <!-- MAP & BOX PANE -->
                        <div class="box box-primary">
                            <div class="table-responsive mailbox-messages"  >
                                <table class="table table-hover table-bordered" id="inbox-table3" href="{{asset('public/backend/css/jquery.dataTables.css')}}">
                                <!-- <table class="table table-hover table-bordered" id="phu-table" href={{URL::to('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css')}}> -->
                                    <tbody>
                                    </tbody><thead>
                                        <tr>
                                        <th>Tên thư đến</th>
                                        <th>Mã nơi gửi</th>
                                        <th>Kích thước</th>
                                        <th>Nơi lưu</th>
                                        <th>Kiểu nhận về</th>
                                        <th>ID người nhận</th>
                                        <th>Thời gian</th>
                                        </tr>
                                    </thead>
                                    </tbody>
                                </table>
                                    @push('scripts')
                                        <script>
                                            $(function inboxTab1() {

                                                var tabletotalInbox3 = $('#inbox-table3').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: '{!! route('users.getdatainboxTotal2') !!}',
                                                    columns: [
                                                        { data: 'name', name: 'name' },
                                                        { data: 'contact_id', name: 'contact_id' },
                                                        { data: 'size', name: 'size' },
                                                        { data: 'path', name: 'path' },
                                                        { data: 'type', name: 'type' },
                                                        { data: 'user_id', name: 'user_id' },
                                                        { data: 'created_at', name: 'created_at' }
                                                    ]
                                                });
                                                setInterval(function() {
                                                tabletotalInbox3.ajax.reload();
                                                }, 120000 );
                                            });
                                        </script>
                                    @endpush
                            <!-- /.class="table-responsive mailbox-messages" -->
                            </div>

                            <!-- /.class="box box-primary -->
                        </div>

                <!-- /.class="col-md-20"" -->
                </div>
            <!--close tab 3-->
            </div>


             <!--open tab 4-->
             <div class="tab-pane active" id="Tab4" role="tabpanel">
             <div class="col-md-20">
                        <!-- MAP & BOX PANE -->
                        <div class="box box-primary">
                            <div class="table-responsive mailbox-messages"  >
                                <table class="table table-hover table-bordered" id="inbox-table4" href="{{asset('public/backend/css/jquery.dataTables.css')}}">
                                <!-- <table class="table table-hover table-bordered" id="phu-table" href={{URL::to('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css')}}> -->
                                    <tbody>
                                    </tbody><thead>
                                        <tr>
                                        <th>Tên thư đến</th>
                                        <th>Mã nơi gửi</th>
                                        <th>Kích thước</th>
                                        <th>Nơi lưu</th>
                                        <th>Kiểu nhận về</th>
                                        <th>ID người nhận</th>
                                        <th>Thời gian</th>
                                        </tr>
                                    </thead>
                                    </tbody>
                                </table>
                                    @push('scripts')
                                        <script>
                                            $(function inboxTab1() {

                                                var tabletotalInbox4 = $('#inbox-table4').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: '{!! route('users.getdatainboxTotal3') !!}',
                                                    columns: [
                                                        { data: 'name', name: 'name' },
                                                        { data: 'contact_id', name: 'contact_id' },
                                                        { data: 'size', name: 'size' },
                                                        { data: 'path', name: 'path' },
                                                        { data: 'type', name: 'type' },
                                                        { data: 'user_id', name: 'user_id' },
                                                        { data: 'created_at', name: 'created_at' }
                                                    ]
                                                });
                                                setInterval(function() {
                                                tabletotalInbox4.ajax.reload();
                                                }, 120000 );
                                            });
                                        </script>
                                    @endpush
                            <!-- /.class="table-responsive mailbox-messages" -->
                            </div>

                            <!-- /.class="box box-primary -->
                        </div>

                <!-- /.class="col-md-20"" -->
                </div>
            <!--close tab 4-->
            </div>


            <!--open tab 5-->
            <div class="tab-pane active" id="Tab5" role="tabpanel">
            <div class="col-md-20">
                        <!-- MAP & BOX PANE -->
                        <div class="box box-primary">
                            <div class="table-responsive mailbox-messages"  >
                                <table class="table table-hover table-bordered" id="inbox-table5" href="{{asset('public/backend/css/jquery.dataTables.css')}}">
                                <!-- <table class="table table-hover table-bordered" id="phu-table" href={{URL::to('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css')}}> -->
                                    <tbody>
                                    </tbody><thead>
                                        <tr>
                                        <th>Tên thư đến</th>
                                        <th>Mã nơi gửi</th>
                                        <th>Kích thước</th>
                                        <th>Nơi lưu</th>
                                        <th>Kiểu nhận về</th>
                                        <th>ID người nhận</th>
                                        <th>Thời gian</th>
                                        </tr>
                                    </thead>
                                    </tbody>
                                </table>
                                @push('scripts')
                                        <script>
                                            $(function inboxTab1() {

                                                var tabletotalInbox5 = $('#inbox-table5').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: '{!! route('users.getdatainboxTotal4') !!}',
                                                    columns: [
                                                        { data: 'name', name: 'name' },
                                                        { data: 'contact_id', name: 'contact_id' },
                                                        { data: 'size', name: 'size' },
                                                        { data: 'path', name: 'path' },
                                                        { data: 'type', name: 'type' },
                                                        { data: 'user_id', name: 'user_id' },
                                                        { data: 'created_at', name: 'created_at' }
                                                    ]
                                                });
                                                setInterval(function() {
                                                tabletotalInbox5.ajax.reload();
                                                }, 120000 );
                                            });
                                        </script>
                                    @endpush
                            <!-- /.class="table-responsive mailbox-messages" -->
                            </div>

                            <!-- /.class="box box-primary -->
                        </div>

                <!-- /.class="col-md-20"" -->
                </div>
            <!--close tab 5-->
            </div>

    </br>
    <!-- /end div tab-content padding top 20 -->
    </div>

<!-- /end div all -->
</div>
