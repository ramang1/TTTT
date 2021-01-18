
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">

      <div class="inner">
        <h3 id ="totalOutBox">{!!$totalOutbox!!}</h3>
        <p>Tổng thư đến</p>
      </div>
      <div class="icon">
        <i class="ion ion ion-email"></i>
      </div>
      <!-- <a href="/outboxes" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a> -->
       <!-- <a href="/outboxTotal" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a> -->
       <a href="/inboxes" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->

  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3 id = "totalInbox">{!! $totalInbox !!}</h3>
        <p>Tổng thư đi</p>
      </div>
      <div class="icon">
        <i class="ion ion ion-email"></i>
      </div>
      <!-- <a href="/inboxes" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>    -->
      <a href="/outboxes" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>

    </div>
  </div>

  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3 id ="totalUnsend">{!! $Unsend!!}</h3>

        <p>Thư chưa gửi</p>
      </div>
      <div class="icon">
        <i class="ion ion ion-email"></i>
      </div>
      <a href="/unsend" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->

  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3 id = "totalUnread">{!!$Unread !!}</h3>
        <p>Thư chưa đọc</p>
      </div>
      <div class="icon">
        <i class="ion ion-email-unread"></i>
      </div>
      <a href="/unreads" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->

</div>
