<div class="box-header with-border">
    <h3 class="box-title" style="font-weight: bold;">Thư chưa đọc</h3>
</div>
<div class="nav-tabs-horizontal">
    <ul class="nav nav-tabs" data-plugin="nav-tabs" role="tablist">

       <!-- /.tab1 -->
      <li class="active"
          role="presentation">
          <a id="tab0"
             data-toggle="tab"
             href="#exampleTabsOne"
             aria-controls="exampleTabsOne"
             role="tab">Tất cả thư
          </a>
      </li>
       <!-- /.end tab1 -->

         <!-- /tab2 -->
      <li role="presentation">
          <a id="tab1"
             data-parent="tab0"
             data-toggle="tab"
             href="#exampleTabsTwo"
             aria-controls="exampleTabsTwo"
             role="tab">Thư theo ngày
      </a>
      </li>
       <!-- /end tab2 -->

       <!-- /tab3 -->
      <li role="presentation">
          <a id="tab1"
             data-parent="tab0"
             data-toggle="tab"
             href="#exampleTabsTwo"
             aria-controls="exampleTabsThree"
             role="tab">Thư theo tuần
      </a>
      </li>
        <!-- /end tab3 -->

        <!-- /tab4 -->
      <li role="presentation">
          <a id="tab1"
             data-parent="tab0"
             data-toggle="tab"
             href="#exampleTabsTwo"
             aria-controls="exampleTabsFour"
             role="tab">Thư theo tháng
      </a></li>
        <!-- /end tab4 -->

        <!-- /tab5 -->
      <li role="presentation">
          <a id="tab1"
             data-parent="tab0"
             data-toggle="tab"
             href="#exampleTabsTwo"
             aria-controls="exampleTabsFive"
             role="tab">Thư theo năm
      </a></li>
        <!-- /tab5 -->
    </ul>

    <div class="tab-content padding-top-20">
    <br>
            <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                    <div class="col-md-20">
                        <!-- MAP & BOX PANE -->
                        <div class="box box-primary">

                            <!-- <div class="box-header with-border">
                                <h3 class="box-title" style="font-weight: bold;">Thư chưa đọc</h3>
                            </div> -->
                        <!-- /.box-header -->
                            <!-- <div class="box-body no-padding">
                                <div class="mailbox-controls">
                                </div>
                                <!-- /.pull-right -->
                        <!--  </div> -->

                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-bordered" id="phu-table" href={{URL::to('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css')}}>
                                    <tbody>
                                    </tbody><thead>
                                        <tr>
                                        <th>Tên thư chưa đọc</th>
                                        <th>Nơi gửi</th>
                                        <th>Kích thước</th>
                                        <th>Nơi lưu</th>
                                        <th>Thời gian</th>
                                        </tr>
                                    </thead>
                                    </tbody>
                                </table>
                                    @push('scripts')
                                        <script>
                                            $(function() {

                                                $('#phu-table').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: '{!! route('users.getdataunread') !!}',
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
                            <!-- /.class="table-responsive mailbox-messages" -->
                            </div>

                            <!-- /.class="box box-primary -->
                        </div>

                <!-- /.class="col-md-20"" -->
                </div>

                <!-- /end div class="tab-pane active" id="exampleTabsOne"-->
            </div>


            <!--open second tab-->
            <div class="tab-pane active" id="exampleTabsTwo" role="tabpanel">

            <!--close second tab-->
            </div>
    </br>
    <!-- /end div tab-content padding top 20 -->
    </div>

<!-- /end div all -->
</div>
