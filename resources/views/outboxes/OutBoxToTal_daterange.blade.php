<!-- ĐÂY LÀ FILE CHẠY OutBoxToTal_daterange.blade.php theo css mới. -->

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />

    <!-- <title>PHP OOP AJAX DATATABLES DATE RANGE</title> -->
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <h1 class="text-center">Thư đến mới</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="from_date" placeholder="From Date" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i
                                        class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="to_date" placeholder="To Date" readonly>
                        </div>
                    </div>
                </div>
                <div>
                    <button id="filter" class="btn btn-outline-info btn-sm">Lọc thư</button>
                    <button id="refresh" class="btn btn-outline-warning btn-sm">Làm mới</button>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered display nowrap" id="records" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>Tên thư đi</th>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <!-- Datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Datatables -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
    </script>
    <!-- Momentjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <script>
    $(function() {
        $("#from_date").datepicker({
            "dateFormat": "dd-mm-yy"
        });
        $("#to_date").datepicker({
            "dateFormat": "dd-mm-yy"
        });
    });
    </script>

    <script>
    // Fetch records

    function fetch(from_date, to_date) {
        $.ajax({
            url: '{{ route("OutBoxToTal_daterange.index") }}',
            // type: "POST",
            data: {
                from_date: from_date,
                to_date: to_date
            },
            dataType: "json",
            success: function(data) {
                // Datatables
                var i = "1";

                $('#records').DataTable({
                    serverSide: true,
                    processing: true,
                    "data": data,
                    // buttons
                    "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    "buttons": [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    // responsive
                    "responsive": true,
                    "columns": [
                            {
                            data:'name',
                            name:'name'
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
                            name:'channel_id',
                            "render": function(data, type, row, meta) {
                            return i++;
                            }
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
        });
    }
    fetch();

    // Filter

    $(document).on("click", "#filter", function(e) {
        e.preventDefault();

        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();

        if (from_date == "" || to_date == "") {
            alert("Xin mời nhập ngày tháng năm cần tìm kiếm!");
        } else {
            $('#records').DataTable().destroy();
            fetch(from_date, to_date);
        }
    });

    // Reset

    $(document).on("click", "#refresh", function(e) {
        e.preventDefault();

        $("#from_date").val(''); // empty value
        $("#to_date").val('');

        $('#records').DataTable().destroy();
        fetch();
    });
    </script>
</body>

</html>
