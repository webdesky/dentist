    function get_doctor(id) {
      
        if (id.length !="") {
            $.ajax({
                
                url: url+'admin/find_record',
                method: "GET",
                dataType: "json",
                data: {
                    id: id,
                    table: 'users',
                    field: 'hospital_id'
                },
                success: function(response) {
                    var option = '<option value="">-- Select Doctor --</option>';
                    for (var i = 0; i < response.length; i++) {
                        option += '<option value="' + response[i].id + '">' + response[i].first_name.toUpperCase() +' '+response[i].last_name.toUpperCase()+ '</option>';
                    }
                    $("#doctor_id").html('');
                    $("#doctor_id").html(option);
                    $("#doctor_id").niceSelect('update');
                },
                error: function() { 
                }
            });
        }
    }