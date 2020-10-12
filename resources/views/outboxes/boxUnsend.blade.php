<div class="box-header with-border">
          <h3 class="box-title" style="font-weight: bold;">Thư chưa gửi</h3>
</div>
<div class="nav-tabs-horizontal">
    <ul class="nav nav-tabs" data-plugin="nav-tabs" role="tablist">
    <!-- <ul class="nav nav-pills" data-plugin="nav-tabs" role="tablist"> -->
       <!-- /.tab1 -->
      <li class="active"
          role="presentation">
          <a id="tab0"
             data-toggle="tab"
             href="#TabsOne"
             aria-controls="TabsOne"
             role="tab">Tất cả thư
          </a>
      </li>
       <!-- /.end tab1 -->

         <!-- /tab2 -->
      <li role="presentation">
          <a id="tab1"
             data-parent="tab1"
             data-toggle="tab"
             href="#TabsTwo"
             aria-controls="TabsTwo"
             role="tab">Thư theo ngày
      </a>
      </li>
       <!-- /end tab2 -->

       <!-- /tab3 -->
      <li role="presentation">
          <a id="tab2"
             data-parent="tab2"
             data-toggle="tab"
             href="#TabsThree"
             aria-controls="TabsThree"
             role="tab">Thư theo tuần
      </a>
      </li>
        <!-- /end tab3 -->

        <!-- /tab4 -->
      <li role="presentation">
          <a id="tab3"
             data-parent="tab3"
             data-toggle="tab"
             href="#TabsFour"
             aria-controls="TabsFour"
             role="tab">Thư theo tháng
      </a></li>
        <!-- /end tab4 -->

        <!-- /tab5 -->
      <li role="presentation">
          <a id="tab4"
             data-parent="tab4"
             data-toggle="tab"
             href="#TabsFive"
             aria-controls="TabsFive"
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
            <div class="tab-pane active" id="TabsOne" role="tabpanel">

            <!-- content of Datatables     -->
            <div class="col-md-20">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-primary">

                        <!-- /.box-header -->
                        <!-- <div class="box-body no-padding">
                        <div class="mailbox-controls">
                            </div>
                            /.pull-right
                        </div> -->
                        <div class="table-responsive mailbox-messagess">
                            <!-- <table class="table table-hover table-stripedd" id="users-table" > -->
                            <table class="table table-hover table-bordered" id="userstable" style="width:100%" href="{{asset('public/backend/css/jquery.dataTables.css')}}">
                            <!-- <table class="table table-hover table-bordered" id="userstable" href={{URL::to('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css')}}> -->
                                <thead>
                                    <tr>
                                    <th>Tên thư chưa gửi</th>
                                    <th>ID</th>
                                    <th>Đường dẫn</th>
                                    <th>Kích thước</th>
                                    <th>Kiểu nén</th>
                                    <th>ID của nhóm nhận</th>
                                    <th>Thời gian</th>
                                    </tr>
                                </thead>
                            </tbody>
                            </table>

                            @push('scripts')
                                <script>
                                    $(function unsendTab1() {
                                        var tableTab1 = $('#userstable').DataTable({
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
                                        setInterval(function() {
                                            tableTab1.ajax.reload();
                                                }, 120000 );
                                    });
                                </script>
                            @endpush
                            <!-- /.table -->
                        </div>
                        <!-- end div class="box box-primary" -->
                    </div>
                <!-- end div class="col-md-20" -->
                </div>
             <!-- end tab div class="tab-pane active" id="exampleTabsOne" role="tabpanel" -->
            </div>


            <!-- div tab 2 -->
            <div class="tab-pane active" id="TabsTwo" role="tabpanel">

            <!-- content of Datatables     -->
            <div class="col-md-20">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-primary">

                        <!-- /.box-header -->
                        <!-- <div class="box-body no-padding">
                        <div class="mailbox-controls">
                            </div>
                            /.pull-right
                        </div> -->
                        <div class="table-responsive mailbox-messagess">
                            <!-- <table class="table table-hover table-stripedd" id="users-table" > -->
                            <table class="table table-hover table-bordered" id="userstable1" style="width:100%" href={{URL::to('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css')}}>
                                <thead>
                                    <tr>
                                    <th>Tên thư chưa gửi</th>
                                    <th>ID</th>
                                    <th>Đường dẫn</th>
                                    <th>Kích thước</th>
                                    <th>Kiểu nén</th>
                                    <th>ID của nhóm nhận</th>
                                    <th>Thời gian</th>
                                    </tr>
                                </thead>
                            </tbody>
                            </table>

                            @push('scripts')
                                <script>
                                    $(function unsendTab2() {
                                        var tableTab2 = $('#userstable1').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: '{!!route('users.unsenddata1')!!}',
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
                                        setInterval(function() {
                                            tableTab2.ajax.reload();
                                                }, 120000 );
                                    });
                                </script>
                            @endpush
                            <!-- /.table -->
                        </div>
                        <!-- end div class="box box-primary" -->
                    </div>
                <!-- end div class="col-md-20" -->
                </div>
             <!-- end tab 2" -->
            </div>

            <!-- div tab 3 -->
            <div class="tab-pane active" id="TabsThree" role="tabpanel">

            <!-- content of Datatables     -->
            <div class="col-md-20">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-primary">

                        <div class="table-responsive mailbox-messagess">
                            <!-- <table class="table table-hover table-stripedd" id="users-table" > -->
                            <table class="table table-hover table-bordered" id="userstable2" style="width:100%" href={{URL::to('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css')}}>
                                <thead>
                                    <tr>
                                    <th>Tên thư chưa gửi</th>
                                    <th>ID</th>
                                    <th>Đường dẫn</th>
                                    <th>Kích thước</th>
                                    <th>Kiểu nén</th>
                                    <th>ID của nhóm nhận</th>
                                    <th>Thời gian</th>
                                    </tr>
                                </thead>
                            </tbody>
                            </table>

                            @push('scripts')
                                <script>
                                    $(function unsendTab3() {
                                        var  tableTab3 = $('#userstable2').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: '{!!route('users.unsenddata2')!!}',
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
                                        setInterval(function() {
                                            tableTab3.ajax.reload();
                                                }, 120000 );
                                    });
                                </script>
                            @endpush
                            <!-- /.table -->
                        </div>
                        <!-- end div class="box box-primary" -->
                    </div>
                <!-- end div class="col-md-20" -->
                </div>
             <!-- end tab 3" -->
            </div>

            <!-- div tab 4 -->
            <div class="tab-pane active" id="TabsFour" role="tabpanel">

            <!-- content of Datatables     -->
            <div class="col-md-20">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-primary">
                        <div class="table-responsive mailbox-messagess">
                            <!-- <table class="table table-hover table-stripedd" id="users-table" > -->
                            <table class="table table-hover table-bordered" id="userstable3" style="width:100%" href={{URL::to('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css')}}>
                                <thead>
                                    <tr>
                                    <th>Tên thư chưa gửi</th>
                                    <th>ID</th>
                                    <th>Đường dẫn</th>
                                    <th>Kích thước</th>
                                    <th>Kiểu nén</th>
                                    <th>ID của nhóm nhận</th>
                                    <th>Thời gian</th>
                                    </tr>
                                </thead>
                            </tbody>
                            </table>

                            @push('scripts')
                                <script>
                                    $(function unsendTab4() {
                                        var tableTab4=$('#userstable3').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: '{!!route('users.unsenddata3')!!}',
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
                                        setInterval(function() {
                                            tableTab4.ajax.reload();
                                                }, 120000 );
                                    });
                                </script>
                            @endpush
                            <!-- /.table -->
                        </div>
                        <!-- end div class="box box-primary" -->
                    </div>
                <!-- end div class="col-md-20" -->
                </div>
             <!-- end tab 4" -->
            </div>

            <!-- div tab 5-->
            <div class="tab-pane active" id="TabsFive" role="tabpanel">

            <!-- content of Datatables     -->
            <div class="col-md-20">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-primary">
                        <div class="table-responsive mailbox-messagess">
                            <!-- <table class="table table-hover table-stripedd" id="users-table" > -->
                            <table class="table table-hover table-bordered" id="userstable4" style="width:100%" href={{URL::to('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css')}}>
                                <thead>
                                    <tr>
                                    <th>Tên thư chưa gửi</th>
                                    <th>ID</th>
                                    <th>Đường dẫn</th>
                                    <th>Kích thước</th>
                                    <th>Kiểu nén</th>
                                    <th>ID của nhóm nhận</th>
                                    <th>Thời gian</th>
                                    </tr>
                                </thead>
                            </tbody>
                            </table>

                            @push('scripts')
                                <script>
                                    $(function unsendTab5() {
                                       var tableTab5=$('#userstable4').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: '{!!route('users.unsenddata4')!!}',
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
                                        setInterval(function() {
                                            tableTab5.ajax.reload();
                                                }, 120000 );
                                    });
                                </script>
                            @endpush
                            <!-- /.table -->
                        </div>
                        <!-- end div class="box box-primary" -->
                    </div>
                <!-- end div class="col-md-20" -->
                </div>
             <!-- end tab 5" -->
            </div>

        </br>

    <!-- /end div tab-content padding top 20 -->
    </div>

<!-- /end div all -->
</div>


