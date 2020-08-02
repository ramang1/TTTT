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
                  

                } else {
                    console.log('Không có dữ liệu cho tuyến liên lạc!!!');
                }

            }
        })


    }, 1000);
});
