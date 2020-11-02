<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thư đi mới</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
 </head>
 <body>
  <div class="container">
     <br />
     <h3 align="center">Thư đi mới</h3>
     <br />
            <br />
            <div class="row input-daterange">
                <div class="col-md-4">
                    <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                </div>
                <div class="col-md-4">
                    <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                </div>
                <div class="col-md-4">
                    <button type="button" name="filter" id="filter" class="btn btn-primary">Lọc thư</button>
                    <button type="button" name="refresh" id="refresh" class="btn btn-default">Làm mới</button>
                </div>
            </div>
            <br />
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="totalOutbox_table">
           <thead>
            <tr>
                <th>Tên thư đi</th>
                <th>ID</th>
                <th>Kích thước</th>
                <th>Nơi lưu</th>
                <th>Kiểu nén</th>
                <th>Tên nhóm nhận</th>
                <th>Tên người thực hiện</th>
                <th>Thời gian</th>
            </tr>
           </thead>
       </table>
    </div>
  </div>
 </body>
</html>

<script>

$(document).ready(function(){
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format:'dd-mm-yyyy',
  autoclose:true
 });

 load_data();

 function load_data(from_date = '', to_date = '')
 {
    // from_date = $('#from_date').datepicker().val();
    // to_date = $('#to_date').datepicker().val();
    // var from_date =$('#from_date').val();
    // var to_date =$('#to_date').val();
    console.log('bat dau load data');
    console.log(from_date);
  $('#totalOutbox_table').DataTable({

   serverSide: true,
   processing: true,
//    serverMethod: POST,
//    type:'POST',
   ajax: {
    url:'{{ route("OutBoxToTal_daterange.index") }}',
    // data:{from_date:from_date, to_date:to_date}

   'data': function(data){
      return {
        from_date: $('#from_date').val(),
        to_date: $('#to_date').val(),
      }
   }
   },
   "columns": [
    {
     data:'name',
     name:'name'
    },
    {
     data:'id',
     name:'id'
    },
    {
     data:'size',
     name:'size'
    },
    {
     data:'path',
     name:'path'
    },
    {
     data:'type',
     name:'type'
    },
    {
     data:'channel_id',
     name:'channel_id'
    },
    {
     data:'user_id',
     name:'user_id'
    },
    {
     data:'created_at',
     name:'created_at'
    }
   ]
  });
 }

 $('#filter').click(function(){
    // var from_date =$('#from_date').val();
    // var to_date =$('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
   $('#totalOutbox_table').DataTable().destroy();
   load_data(from_date, to_date);
  }
  else
  {
   alert('Both Date is required');
  }
 });

 $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  $('#totalOutbox_table').DataTable().destroy();
  load_data();
 });

});
</script>
