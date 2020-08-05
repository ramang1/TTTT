window.onload = function () {
    console.log('loaded page');
};

$(document).ready(function () {
   
    var refreshId = setInterval(function () {
        

        let _url = `/dashboard/get_total`;
        $.ajax({
            url: _url,
            method: 'get',
            dataType: 'json',

            success: function(data) {
                if (data) {

                    
                    $("#totalInbox").html(data.totalInbox);
                    $("#totalOutBox").html(data.totalOutbox);
                    $("#totalUnread").html(data.totalUnread);
                    $("#totalUnsend").html(data.totalUnsend);

                    for (i=0; i<data.inbox_contact_info.length; i++) {
                        //Neu id chua ton tai
                            if ($('#li_' + data.inbox_contact_info[i].id).length ===0){
                               // $('ul[class="nav nav-pills nav-stacked"]').append("<li id =li_ >" + "<a href=\"mailbox.html\">Inbox<span class=\"label label-primary pull-right\">120</span></a></li>");

                            }else{
                        // Neu id da ton tai
                                
                            }
                    }
                    //$('ul[class="nav nav-pills nav-stacked"]').append("<li><a href=\"mailbox.html\">Inbox<span class=\"label label-primary pull-right\">120</span></a></li>");
                  console.log(data.inbox_contact_info.length);

                } else {
                    console.log('Không có dữ liệu cho tuyến liên lạc!!!');
                }

            }
        })


    }, 1000);
});
