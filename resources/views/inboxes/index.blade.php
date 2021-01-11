@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1 class="pull-left">Tổng thư đến</h1>
  <!-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('inboxes.create') }}">Add New</a>
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
      <!-- @include('inboxes.table') -->
      <table class="table table-striped table-bordered" id="dataTableBuilder" width="100%">
        <thead>
          <tr>
            <th title="Tên thư đến">Tên thư đến</th>
            <th title="Mã nơi gửi">Mã nơi gửi</th>
            <th title="Kích thước file">Kích thước file</th>
            <th title="Thư mục lưu">Thư mục lưu</th>
            <th title="Kiểu nhận về">Kiểu nhận về</th>
            <th title="Thời gian">Thời gian</th>
            <th title="Action" width="120px">Action</th>
          </tr>
        </thead>
      </table>

    </div>
  </div>
  <div class="text-center">
    <p>TOng thu di</p>
    <p>TOng thu den</p>

  </div>
</div>
@endsection

@push('scripts')
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
</script>
<script>
  var startDate = 0;
  var endDate = 0;;
  var table = $('#dataTableBuilder').DataTable({

    serverSide: true,
    processing: true,
    ajax: {
      url: "/inboxesdata",
      type: "GET",
      data: function(d){
        d.startDate = startDate;
        d.endDate = endDate;
        
      }
    },

    columns: [{
      name: "name",
      data: "name",
      title: "T\u00ean th\u01b0 \u0111\u1ebfn",
      orderable: true,
      searchable: true
    }, {
      name: "contact_id",
      data: "contact_id",
      title: "M\u00e3 n\u01a1i g\u1eedi",
      orderable: true,
      searchable: true
    }, {
      name: "size",
      data: "size",
      title: "K\u00edch th\u01b0\u1edbc file",
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
      title: "Ki\u1ec3u nh\u1eadn v\u1ec1",
      orderable: true,
      searchable: true
    }, {
      name: "created_at",
      data: "created_at",
      title: "Th\u1eddi gian",
      orderable: true,
      searchable: true
    }, {
      "defaultContent": "",
      data: "action",
      name: "action",
      title: "Action",
      render: null,
      orderable: false,
      searchable: false,
      width: "120px"
    }],
    dom: "Bfrtip",
    stateSave: true,
    order: [
      [5, "desc"]
    ],
    "buttons": [{
      extend: "export",
      text: "Xu\u1ea5t file",
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
    }]

  });

  //Date range as a button
  $('#daterange-btn').daterangepicker({
      ranges: {
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
      $('#daterange-btn span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
      startDate = start.format('YYYY/MM/DD');
      endDate = end.format('YYYY/MM/DD');
    }
  )

  // Function for converting a mm/dd/yyyy date value into a numeric string for comparison (example 08/12/2010 becomes 20100812
  function parseDateValue(rawDate) {
    var dateArray = rawDate.split("/");
    var parsedDate = dateArray[2] + dateArray[0] + dateArray[1];
    return parsedDate;
  }


  $(function() {
    $('#dateFiler').click(function() {
      console.log('goi ham ' + startDate + " " + endDate);
      table.draw();

    });
  });
</script>
@endpush