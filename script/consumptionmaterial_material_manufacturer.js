$(document).ready(function(){
            
    load_data();
    
    function load_data(query)
    {
        $.ajax({
            url:"/admin/consumptionmaterial/consumptionmaterial_material_manufacturer.php",
            method:"POST",
            data:{query:query},
            success:function(data)
            {
                $('#material_manufacturer').html(data);
            }
        });
    }

    $('#name_material').change(
        function(){
            var search = $(this).val();
            if(search != '')
            {
                load_data(search);
            }
            else
            {
                load_data();
            }
        }
    );
});