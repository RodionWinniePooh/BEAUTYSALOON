$(document).ready(function(){
            
    var time = $(this).val();
    var date = $('#DateNow').val();

    load_data(time,date);
    
    function load_data(time, date)
    {
        $.ajax({
            url:"/admin/visit/visit_customer_is_free.php",
            method:"POST",
            data:{time:time, date:date},
            success:function(data)
            {
                $('#customer_is_free').html(data);
            }
        });
    }

    $('#visit').keyup(
        function(){
            var time = $(this).val();
            var date = $('#DateNow').val();

            if(time != '' && date != '')
            {
                load_data(time, date);
            }
            else
            {
                load_data();
            }
        }
    );


});