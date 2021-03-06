@extends('layouts.app')
@include('inboxes.table')
@section('content')
<section class="content-header">
  <h1 class="pull-left">{{ Request::is('outboxes/unsends') ? 'Thư chưa gửi' : "Tổng thư đi" }}</h1>
  <!-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('outboxes.create') }}">Add New</a>
        </h1> -->
</section>
<div class="content">
  <div class="clearfix"></div>

  @include('flash::message')

  <div class="clearfix"></div>

  <div class="input-group input-group-sm">
    <button type="button" class="btn btn-default pull-right" id="daterange-btn">
      <span>Chọn thời gian</span>
      <i class="fa fa-caret-down"></i>
    </button>
    <span class="input-group-btn">
      <button type="button" class="btn btn-info btn-flat" id="dateFiler">Lọc!</button>
    </span>
  </div>

  <div class="box box-primary">
    <div class="box-body">
      @include('outboxes.table')
      <table class="table table-striped table-bordered" id="dataTableBuilder" width="100%">
        <thead>
          <tr>
            <!-- <th title="id">id</th> -->
            <th title="Tên thư đi">Tên thư đi</th>
            <th title="Nơi nhận">Nơi nhận</th>
            <th title="Nhóm nhận">Nhóm nhận</th>
            <th title="Kích thước file">Size</th>
            <th title="Thư mục lưu">Thư mục lưu</th>
            <th title="Kiểu nén">Kiểu nén</th>
            <th title="Id của người thực hiện">Người gửi</th>
            <th title="Thời gian">Thời gian</th>
            <th title="Action" width="120px">Action</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  
</div>
@endsection

@push('scripts')

<script>
  var startDate = 0;
  var endDate = 0;;
  var table = $('#dataTableBuilder').DataTable({
    dom: "Blfrtip",
    lengthChange: false,
  serverSide: true,
  processing: true,
  ajax: {
    url: "{{ route('outboxesdata') }}",
    type: "GET",
    data: function(d) {
      d.url = window.location.pathname;
      console.log("outbox" + d.url);
      d.startDate = startDate;
      d.endDate = endDate;
    }
  },

  columns: [

  {
    name: "name",
    data: "name",
    title: "T\u00ean th\u01b0 \u0111i",
    orderable: true,
    searchable: true
  },{
    name: "contact_id",
    data: "contact_id",
    title: "N\u01a1i nh\u1eadn",
    orderable: true,
    searchable: true
  },{
    name: "channel_id",
    data: "channel_id",
    title: "Nhóm nhận",
    orderable: true,
    searchable: true
  },{
    name: "size",
    data: "size",
    title: "Size",
    orderable: true,
    searchable: true
  }, {
    name: "path",
    data: "path",
    title: "Th\u01b0 m\u1ee5c l\u01b0u",
    orderable: true,
    searchable: true
  }, {
    name: "type",
    data: "type",
    title: "Ki\u1ec3u n\u00e9n",
    orderable: true,
    searchable: true
  }, {
    name: "user_id",
    data: "user_id",
    title: "Người gửi",
    orderable: true,
    searchable: true
  }, {
    name: "created_at",
    data: "created_at",
    title: "Th\u1eddi gian",
    orderable: true,
    searchable: true
  }, {
    defaultContent: "",
    data: "action",
    name: "action",
    title: "Action",
    render: null,
    orderable: false,
    searchable: false,
    width: "70px"
  }],
  
  "buttons": [
      {
        extend: "copyHtml5",
        text: "Sao chép",
        className: "btn btn-default btn-sm no-corner"
      },
      {
        extend: "colvis",
        text: "Ẩn cột",
        className: "btn btn-default btn-sm no-corner"
      },
      {
        extend: "excelHtml5",
        text: "Excel",
        className: "btn btn-default btn-sm no-corner"
      }, 
      {
        extend: "pdfHtml5",
        text: "PDF",
        className: "btn btn-default btn-sm no-corner"
      }, {
        
        extend: "print",
        className: "btn btn-default btn-sm no-corner"
      }, {
        extend: "reset",
        className: "btn btn-default btn-sm no-corner"
      }, {
        extend: "reload",
        className: "btn btn-default btn-sm no-corner"
      },
      {
        extend: "pageLength",
       
        className: "btn btn-default btn-sm no-corner"

      },
    ],
    stateSave: true,
    order: [
      [7, "desc"]
    ]
  });

  //Date range as a button
  $('#daterange-btn').daterangepicker({
      ranges: {
        'Tất cả': [null,null],
        'Hôm nay': [moment(), moment()],
        'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 ngày trước': [moment().subtract(6, 'days'), moment()],
        '30 ngày trước': [moment().subtract(29, 'days'), moment()],
        'Tháng này': [moment().startOf('month'), moment().endOf('month')],
        'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment(),

      locale: {
        "format": "DD/MM/YYYY",
        "applyLabel": "Đồng ý",
        "cancelLabel": "Huỷ",
        "customRangeLabel": "Tuỳ chọn",
        "monthNames": [
          "Tháng Một",
          "Tháng Hai",
          "Tháng Ba",
          "Tháng Tư",
          "Tháng Năm",
          "Tháng Sáu",
          "Tháng Bảy",
          "Tháng Tám",
          "Tháng Chín",
          "Tháng Mười",
          "Tháng Mười một",
          "Tháng Mười hai"
        ],
        "fromLabel": "Từ",
        "toLabel": "Đến",
      },

    },
    function(start, end) {

      if(start._isValid && end._isValid)
        {
          $('#daterange-btn span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
          startDate = start.format('YYYY/MM/DD');
         endDate = end.format('YYYY/MM/DD');
        }
        else
        {
          $('#daterange-btn span').html('Chọn thời gian');
            startDate =0;
            endDate = 0;
        }
    }
  )

  $(function() {
    $('#dateFiler').click(function() {
      console.log('goi ham ' + startDate + " " + endDate);
      table.draw();

    });
  });
</script>
@endpush
