<?php
session_start();
require_once "../start.php";

    $connect = mysqli_connect("localhost", "root", "", "beautysaloon");
    $output = '';
    $query = '';


    if(isset($_POST["query"]))
    {
        $search = mysqli_real_escape_string($connect, $_POST["query"]);

        $query = "SELECT 
                        Visit.id_visit,
                        Customer.first_and_last_name, 
                        Customer.phone_number, 
                        Service.name_service, 
                        Employee.full_name, 
                        Visit.date_of_visit, 
                        Visit.time_of_visit, 
                        Visit.service_provided, 
                        round((100 - Customer.customer_discount) / 100 * Service.price, 2) as discount
                FROM Customer INNER JOIN Service INNER JOIN Employee INNER JOIN Visit 
                ON Customer.id_customer = Visit.id_customer AND Service.id_service = Visit.id_service AND Employee.id_employee = Visit.id_employee 
                WHERE 
                Customer.first_and_last_name LIKE '%$search%' OR
                Customer.phone_number LIKE '%$search%' OR
                Service.name_service LIKE '%$search%' OR
                Employee.full_name LIKE '%$search%' OR
                Visit.date_of_visit LIKE '%$search%' OR
                Visit.time_of_visit LIKE '%$search%' OR
                Visit.service_provided LIKE '%$search%'";                  

    }
    else
    {
     $query = "SELECT 
                    Visit.id_visit,
                    Customer.first_and_last_name, 
                    Customer.phone_number, 
                    Service.name_service, 
                    Employee.full_name, 
                    Visit.date_of_visit, 
                    Visit.time_of_visit, 
                    Visit.service_provided, 
                    round((100 - Customer.customer_discount) / 100 * Service.price, 2) as discount
               FROM Customer INNER JOIN Service INNER JOIN Employee INNER JOIN Visit 
               ON Customer.id_customer = Visit.id_customer AND Service.id_service = Visit.id_service AND Employee.id_employee = Visit.id_employee";
    }



 

    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $output .= '
            <table id="myTable" class="material_table">
                <thead> 
                <tr id="point_cursor">
                    <th onclick="sortTable(0)">Имя и фамилия клиента</th>
                    <th onclick="sortTable(1)">Номер клиента</th>
                    <th onclick="sortTable(2)">Услуга</th>

                    <th onclick="sortTable(3)">Дата посещения</th>
                    <th onclick="sortTable(4)">Время посещения</th>
                    <th onclick="sortTable(5)">ФИО сотрудника</th>
                    <th onclick="sortTable(6)">Цена с учётом скидки</th>
                    <th onclick="sortTable(7)">Услуга оказана</th>
                    
                    
                    <th></th>
                </tr>
            </thead>
           
            <tbody>
            
        ';
        while($row = mysqli_fetch_array($result))
        {
            $service ='';
            if($row["service_provided"] == 1)
            {
                $service .= '
               
                    <option class="input_min" selected value="1">Да</option> 
             
                ';
            }
            if($row["service_provided"] == 0)
            {
                $service .= '
                    <form method="post" action="/admin/query_update.php">
                        <input type="hidden" name="edit_id"  value="'.$row["id_visit"].'">
                        <select class="input_min" name="service_provided"> 
                            <option  value="1">Да</option> 
                            <option selected value="0">Нет</option>
                        </select>
                        <br>
                        <input style="margin-top:5px" type="submit" value="Подтвердить" class="input_min btn_green" name="service_btn">
                    </form>
                ';
            }


            $output .= '
    
          
            <tr>
                <td>'.$row["first_and_last_name"].'</td>
                <td><a href="tel:+375'.$row["phone_number"].'">'.$row["phone_number"].'</a></td>
                <td>'.$row["name_service"].'</td>
                <td>'.$row["date_of_visit"].'</td>
                <td>'.$row["time_of_visit"].'</td>
                <td>'.$row["full_name"].'</td>
                <td>'.$row["discount"].'</td>
                <td>
                 
                        '.$service.'
                
                </td>

                

                <td>
                    <form method="post" action="/admin/visit/visit_edit.php">
                        <input type="hidden" name="edit_id"  value="'.$row["id_visit"].'">
                        <input type="submit" name="edit_btn" value="Редактировать" class="rectangle_btn btn_gray">
                    </form>

                </td>
            </tr>
           
            ';
        }
        $output .= ' </tbody></table>';

        echo $output;
        mysqli_close($connect);
    }
    else
    {
        echo '<h2 style="margin:10px;">Данные не найдены</h2>';
    }

?>