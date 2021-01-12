window.onload = function () {
<<<<<<< HEAD
    
};

function getMailServer() {
    const newLocal = `/listmail1`;
    let _url = newLocal;
    $.ajax({
        url: _url,
        method: 'get',
        dataType: 'json',
        success: function (data) {
                if (data.length > 0) {
                    $("#tuananhP").find("tr").remove();
                    data.forEach(function (item) {
                        $("#tuananhP").append(createTr(item));
                    })
                }else{
                    console.log('Ko co du lieu tra ve tu server');
                }
        }
    })
} //end function

function createTr(item) {
    var tr = '<tr>' +
        '<td><div class="icheckbox_flat-blue" name="checkbox" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></td>' +
        '<td><input type="checkbox"  name="process_inbox['+ item.id + ']" href="/action/' + item.id + item.user_id +'" value="1" id="checkboxmail"></td>' +
        '<td><div id="checktext" style="display:none">Đã chọn</div></td>' +
        '<td class="mailbox-name"><a href="/action/' + item.id + '">' + item.name + '</a></td>' +
        '<td><b>' + item.contact_name + '</b></td>' +
        '<td>' + item.timeCarbon + '</td>' +
        '</tr>';
    return tr;
}
$(document).ready(function(){  
    $('#button1').click(function(){  
         var data = [];  
         $('#checkboxmail').each(function(){  
              if($(this).is(":checked"))  
              {  
                   data.push($(this).val());  
              }  
         });  
         data = data.toString();  
         console.log('data: ' + data);
         $.ajax({  
              url:"/InboxController/actiongiainen",  
              method:"POST",
              dataType:"json",  
              data:{data:data},  
              success:function(data){ 
                  console.log('thanhcong');  
              }  
         });  
    });  
});  
=======
    //get_total();
    // get_total();
    // show_inbox();
    // check_mail();
    // getMailServer();
    // ApplyCss();
    // unreadTab1();
    // unreadTab2();
    // unreadTab3();
    // unreadTab4();
    // unreadTab5();
    // RefreshButton();
    // unsendTab1();
    // unsendTab2();
    // unsendTab3();
    // unsendTab4();
    // unsendTab5();

    // inboxTab1();
    // inboxTab2();
    // inboxTab3();
    // inboxTab4();
    // inboxTab5();

    // outboxTab1();
    // outboxTab2();
    // outboxTab3();
    // outboxTab4();
    // outboxTab5();

};

// function getMailServer() {
//     const newLocal = `/listmail1`;
//     let _url = newLocal;
//     $.ajax({
//         url: _url,
//         method: 'get',
//         dataType: 'json',
//         success: function (data) {
//                 if (data.length > 0) {
//                     $("#tuananhP").find("tr").remove();
//                     data.forEach(function (item) {
//                         $("#tuananhP").append(createTr(item));
//                     })
//                 }else{
//                     console.log('Ko co du lieu tra ve tu server');
//                 }
//         }
//     })
// } //end function

// function createTr(item) {
//     var tr = '<tr>' +
//         // '<td><div class="icheckbox_flat-blue" name="checkbox" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></td>' +
//         // '<td><input type="checkbox"  name="process_inbox['+ item.id + ']" href="/action/' + item.id + item.user_id +'" value="1" id="checkboxmail"></td>' +
//         '<td><div id="checktext" style="display:none">Đã chọn</div></td>' +
//         '<td class="mailbox-name"><a href="/chi-tiet-mail/' + item.id + '">' + item.name + '</a></td>' +
//         '<td><b><a href="/chi-tiet-mail/' + item.id + '">' + item.contact_name + '</b></td>' +
//         '<td>' + item.timeCarbon + '</td>' +
//         '</tr>';
//     return tr;
// }

//Auto click refresh button
// function RefreshButton() {
//     $.ajax({
//         url: '/',
//         type: 'get',
//         success:function(data){
//           $('#RefreshButton').trigger("click");
//         }
    
//     })
// };
>>>>>>> d2f534f... Inbox-Outbox-Index


function get_total() {
    let _url = `/dashboard/get_total`;
    $.ajax({
        url: _url,
        method: 'get',
        dataType: 'json',

        success: function (data) {
            if (data) {
                $("#totalInbox").html(data.totalInbox); //set gia tri tren trang hTML the co ID la totalInbox thanh data.totalInbox= 0
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
<<<<<<< HEAD

    //var refreshId = setInterval(get_total, 10000000);
  //  var refreshId = setInterval(getMailServer, 1000);
=======
    // var refreshId = setInterval(RefreshButton, 1000);
    var refreshId = setInterval(get_total, 10000000);
    var refreshId = setInterval(getMailServer, 20000);
>>>>>>> d2f534f... Inbox-Outbox-Index
});
//TuanAnh
function show_inbox() {
    var table = $('#showinbox').DataTable({

        stateSave: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: 'http://127.0.0.1:8000/listmail'
        },
        columns: [{
                data: 'name',
                name: 'name'
            },
            {
                data: 'path',
                name: 'path'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
        ]
    });
    // setInterval(function () {
    //     table.ajax.reload();
    // }, 1000);
}



