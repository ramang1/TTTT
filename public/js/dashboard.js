window.onload = function () {
  
    
};

var x = setInterval(function() {
    refreshPage();
}, 10000);

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


            } else {
                console.log('Không có dữ liệu cho tuyến liên lạc!!!');
            }

        }
    })
}




function playAudio() {
var x = document.getElementById("myAudio");
  x.play();
}

function refreshPage(){
    console.log('Chung toi se reload lai webste');
    
    location.reload();

   
}
$(document).ready(function () {

    var unRead = $('#totalUnread').text();
    if (unRead > 0) {
        //playAudio();
        console.log('co dien den ' + unRead);
      
    }
    
       
    
    
})



