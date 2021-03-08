<div class="row">
  <!-- Left col -->
  <div class="col-md-8">
   

    <!-- TABLE: THƯ ĐẾN -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">THƯ ĐẾN</h3>
        <!-- <button onclick="refreshPage()" type="button" id="RefreshButton" name="RefreshButton" class="btn btn-default btn-sm"><i class="fa fa-refresh"></a></i></button> -->
        <button onclick="refreshPage()" type="button" class="btn btn-default btn-sm"><a href=""><i class="fa fa-refresh"></i></a></button>
        
        
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body" style="">
        <div class="table-responsive mailbox-messages">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th><b>Tên</b></th>
                <th><b>Nơi gửi</b></th>
                <th><b>Người nhận</b></th>
                <th><b>Kích thước</b></th>
                <th><b>Trạng thái</b></th>
                <th><b>Kiểu nhận thư</b></th>
                <th><b>Ngày nhận</b></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($showinbox as $data)
              <tr>
                <td><a href="{{URL::to('/inboxes/'.$data->id)}}">{{$data->name}}</a></td>
                <td><a href="{{URL::to('/users')}}">{{$data->contacts_name}}</a></td>
                <td><a href="{{URL::to('/users')}}">{{$data->users_name}}</a></td>
                <td>{{($data->size)}}</td>
                <td>
                  <?php
                  if ($data->action == 'giai_nen_zip' || $data->action == 'giai_nen_rar') {
                  ?>
                    <a><span class="label label-success">Đã giải mã</span></a>
                  <?php
                  } else {
                  ?>
                    <a><span class="label label-danger">Chưa giải mã</span></a>
                  <?php
                  }
                  ?>
                </td>
                <td>
                  <?php
                  if ($data->action == NULL) {
                  ?>
                    <a><span class="label label-danger">Chưa xử lý</span></a>
                  <?php
                  } else {
                  ?>
                    <a><span class="label label-success">{{$data->action}}</span></a>
                  <?php
                  }
                  ?>
                </td>
                {{-- <td><span class="label label-success">{{($data->action)}}</span></td> --}}
                <td>{{Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix" style="">
        {{-- <a href="" class="btn btn-sm btn-info btn-flat pull-left">Kiểm tra thư đến</a> --}}
        <a href="{{URL::to('/inboxes')}}" class="btn btn-sm btn-default btn-flat pull-right">Xem tất cả thư đến</a>
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
    <!-- TABLE: THƯ ĐI -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">THƯ ĐI</h3>
        
        <audio id="myAudio">

          <source src="media/{!! settings('audio_file')!!}" type="audio/mpeg">
        </audio>
        
        <button onclick="refreshPage()" type="button" class="btn btn-default btn-sm"><a href=""><i class="fa fa-refresh"></a></i></button>
        
       

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body" style="">
        <div class="table-responsive mailbox-messages">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th><b>Tên</b></th>
                <th><b>Người nhận mail<b></th>
                <th><b>Người gửi mail<b></th>
                <th><b>Kích thước</b></th>
                <th><b>Kiểu nén</b></th>
                <th><b>Ngày tạo</b></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($showoutbox as $data)
              <tr>
                <td><a href="{{URL::to('/outboxes/'.$data->outboxes_id)}}">{{$data->name}}</a></td>
                <td><a href="{{URL::to('/users')}}">{{$data->contacts_name}}</a></td>
                <td><a href="{{URL::to('/users')}}">{{$data->users_name}}</a></td>
                <td>{{($data->size)}}</td>
                <td><span class="label label-success">{{($data->action)}}</span></td>
                <td>{{Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix" style="">
        {{-- <a href="" class="btn btn-sm btn-info btn-flat pull-left">Kiểm tra thư đi</a> --}}
        <a href="{{URL::to('/outboxes')}}" class="btn btn-sm btn-default btn-flat pull-right">Xem tất cả thư đi</a>
      </div>
      <!-- /.box-footer -->
    </div>

  </div>
  <!-- /.col -->




  <div class="col-md-4">

    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Tuyến</h3>

        <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body no-padding">
        @foreach ($contactMailDetail as $data)
        <ul class="nav nav-pills nav-stacked">
          <li class="list-group-item"><a href="#"> {{$data->name}}
              <span class="label label-danger pull-right">{{$data->DIENDI}}</span><span class="label label-primary pull-right">{{$data->DIENDEN}}</span></a></li>
          {{-- <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
          <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
          <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
          </li>
          <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li> --}}
        </ul>
        @endforeach
      </div>
      <!-- /.box-body -->
      
    </div>

    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Người dùng</h3>
        
        <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body no-padding">
        
        
        <ul class="nav nav-pills nav-stacked">
          @foreach ($userMailDetail as $data)
          <li class="list-group-item"><a href="#"> {{$data->name}}
            <span class="label label-danger pull-right">{{$data->TRUYENDIEN}}</span><span class="label label-primary pull-right">{{$data->NHANDIEN}}</span></a></li>
          {{-- <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox
              <span class="label label-primary pull-right">12</span></a></li>
          <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
          <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
          <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
          </li>
          <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li> --}}
          @endforeach
        </ul>
            
        
      </div>
      <!-- /.box-body -->
      
    </div>

    <!-- Info Boxes Style 2 -->
    <div class="info-box bg-yellow">
      <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Số lượng Tuyến</span>
        <span class="info-box-number">{{$totalUnread_inbox->count()}</span>

        <div class="progress">
          <div class="progress-bar" style="width: 50%"></div>
        </div>
        <span class="progress-description">
              50% Increase in 30 Days
            </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Tổng số lượng Đơn vị có liên lạc</span>
        <span class="info-box-number">92,050</span>

        <div class="progress">
          <div class="progress-bar" style="width: 20%"></div>
        </div>
        <span class="progress-description">
              20% Increase in 30 Days
            </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    <div class="info-box bg-red">
      <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Số lượng ID đơn vị hiện tại</span>
        <span class="info-box-number">114,381</span>

        <div class="progress">
          <div class="progress-bar" style="width: 70%"></div>
        </div>
        <span class="progress-description">
              70% Increase in 30 Days
            </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    <div class="info-box bg-aqua">
      <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Tổng số lượng thư gửi/nhận trong ngày</span>
        <span class="info-box-number">163,921</span>

        <div class="progress">
          <div class="progress-bar" style="width: 40%"></div>
        </div>
        <span class="progress-description">
              40% Increase in 30 Days
            </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->

    
    <!-- /.box -->

    <!-- PRODUCT LIST -->
    
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>