window.onload = function () {get_total();
    get_total();
    show_inbox();
    check_mail();
};

function get_total() {
    let _url = `/dashboard/get_total`;
    $.ajax({
        url: _url,
        method: 'get',
        dataType: 'json',

        success: function (data) {
            if (data) {


                $("#totalInbox").html(data.totalInbox);
                $("#totalOutBox").html(data.totalOutbox);
                $("#totalUnread").html(data.totalUnread);
                $("#totalUnsend").html(data.totalUnsend);

                for (i = 0; i < data.inbox_contact_info.length; i++) {
                    //Neu id chua ton tai
                    if ($('#li_' + data.inbox_contact_info[i].id).length === 0) {
                        // $('ul[class="nav nav-pills nav-stacked"]').append("<li id =li_ >" + "<a href=\"mailbox.html\">Inbox<span class=\"label label-primary pull-right\">120</span></a></li>");

                    } else {
                        // Neu id da ton tai

                    }
                }
                //$('ul[class="nav nav-pills nav-stacked"]').append("<li><a href=\"mailbox.html\">Inbox<span class=\"label label-primary pull-right\">120</span></a></li>");
               

            } else {
                console.log('Không có dữ liệu cho tuyến liên lạc!!!');
            }

        }
    })
}
$(document).ready(function () {

    var refreshId = setInterval(get_total, 100000);
});
//TuanAnh
function show_inbox(){
    
    var table = $('#showinbox').DataTable({
        paging: false,
        stateSave: true,
        processing: true,
        serverSide: true,
        ajax: {
                    url: 'http://127.0.0.1:8000/listmail'    
                },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'path', name: 'path'},
            {data: 'created_at', name: 'created_at'},
            // {data: 'updated_at', name: 'updated_at'}
        ]
    });
    setInterval(function() {
        table.ajax.reload();
        }, 10000 );
}

function check_mail(){
    var table = $('#CheckMail').DataTable({
        paging: false,
        stateSave: true,
        processing: true,
        serverSide: true,
        ajax: '/checkmail',
        columns: [
          {data: 'name', name: 'inboxes.name'},
          {data: 'note', name: 'process_inbox.note'},
          {data: 'action', name: 'process_inbox.action'},
          {data: 'description', name: 'process_inbox.description'},
          {data: 'created_at', name: 'process_inbox.created_at'}
              ],
          });
          setInterval(function() {
            table.ajax.reload();
            }, 10000 );
            
          
}

