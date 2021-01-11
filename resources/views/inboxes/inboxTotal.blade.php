


<div class="box-body table-responsive">
                        <div class="row">
                            <div class="col-xs-4 form-inline" style="position: absolute; z-index: 2;">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-sm form-control" name="start" value="" />
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="input-sm form-control" name="end" value=""/>
                                </div>
                                <button type="button" id="dateSearch" class="btn btn-sm btn-primary">Search</button>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover" id="orders-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Street</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zip</th>
                                    <th>Email</th>
                                    <th>Domain</th>
                                    <th align="center" style="padding-right: 15px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <script>
                    var oTable = $('#orders-table').DataTable({
                dom: 'frtBp',
                buttons: [
                    {
                        text: 'Print Selected Orders',
                        action: function ( e, dt, node, config )
                              {
                                  alert( 'You clicked me!' );
                              }
                    }
                ],
                stateSave: true,
                paging:     true,
                pagingType: 'simple_numbers',
                lengthMenu: [ [ 15, 30, 50, -1 ], [ 15, 30, 50, "All" ] ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: 'localhost.com',
                        data: function(d) {
                            d.start = $('input[name=start]').val();
                            d.end = $('input[name=end]').val();
                        }
                    },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'order_date', name: 'order_date' },
                    { data: 'ship_name', name: 'ship_name' },
                    { data: 'ship_company', name: 'ship_company' },
                    { data: 'ship_street1', name: 'ship_street1'},
                    { data: 'ship_city', name: 'ship_city' },
                    { data: 'ship_state', name: 'ship_state' },
                    { data: 'ship_zip', name: 'ship_zip' },
                    { data: 'contact_email', name: 'contact_email'},
                    { data: 'domain', name: 'domain'},
                    { data: 'action', name: 'action', orderable: false, searchable: false, width: '10px', sClass: "selectCol" },
                ]
            });
    $('.input-daterange').datepicker({
                 autoclose: true,
                 todayHighlight: true
            });

            $('#dateSearch').on('click', function() {
                oTable.draw();
            });
                    </script>