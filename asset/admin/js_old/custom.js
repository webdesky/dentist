$(document).ready(function() {
    //site_url = get_url();
    t = jQuery('#example').dataTable({
        aoColumnDefs: [{
            bSortable: false,
            aTargets: [0, 3, 4]
        }]
    });


    /**************** Cancel Button Script Start *************/

    $('body').on('click', '.cancel-btn', function() {
        $('.download-salary').attr('href', 'javascript:void(0)');
        $('input,select').val("");
    });

    /**************** Cancel Button Script End ***************/


    // ************* Jquery Data Table Start's ***************/

    $('#example').DataTable({
        columnDefs: [{
            targets: [0],
            orderData: [0, 1]
        }, {
            targets: [1],
            orderData: [1, 0]
        }, {
            targets: [4],
            orderData: [4, 0]
        }]
    });

    $('#example1').DataTable({
        columnDefs: [{
            targets: [0],
            orderData: [0, 1]
        }, {
            targets: [1],
            orderData: [1, 0]
        }, {
            targets: [4],
            orderData: [4, 0]
        }]
    });

    // ************* Jquery Data Table End's ***************/


});




function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}


var delay = (function() {
    var timer = 0;
    return function(callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();



function search_email(str) {
    if (str === "" || (!isValidEmailAddress(str))) {
        $(".email_msg").css({
            "color": "red"
        });
        $(".email_msg").html("please fill valid email");
        $("#email").val('');
        $("#email").focus();
        return false;
    } else {
        delay(function() {
            $.ajax({
                url: "search_email",
                type: "POST",
                data: {
                    email: str,
                },
                success: function(data) {
                    if (data === "success") {
                        $(".email_msg").html('');
                    } else if (data === "error") {
                        $(".email_msg").css({
                            "color": "red"
                        });
                        $(".email_msg").html("email already exists");
                        $("#email").val('');
                        $("#email").focus();
                    }
                },
            });
        }, 500);
    }
}

function readURL(input, index) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        if (input.files[0].size > 4000000) {
            $("#img_err").html("file size can not be more than 4mb");
            return false;
        } else {
            $("#img_err").html('');
        }
        reader.onload = function(e) {
            $('#blah_' + index).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).on("change", ".imageMap", function() {
    var index = this.id.split('_');
    id = $(this).attr('id');
    console.log(id);
    readURL(this, index[1]);
});

function goBack() {
    window.history.back();
}

    function delete_record(table_name,id){
        if(confirm("Are you sure want to delete this record?")) {
            $.ajax({
              url: "delete_record",
              type: "POST",
              data: {id : id, table_name:table_name},
              success: function(data) {
                window.location.reload();
                },
            }); 
        }else{
              return false;
           }       
    }

    function change_status(table_name,id,status_id){
        if(confirm("Are you sure want to change status?")) {
            $.ajax({
              url: "change_status",
              type: "POST",
              data: {id : id, table_name:table_name,status_id:status_id},
              success: function(data) {
                    window.location.reload();
                },
            }); 
        }else{
              return false;
           }       
    }