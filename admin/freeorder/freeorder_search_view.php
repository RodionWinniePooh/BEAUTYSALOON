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
                    Freeorder.id_free_order, 
                    Customer.first_and_last_name, 
                    Service.name_service, 
                    Freeorder.date_of_visit, 
                    Freeorder.time_of_visit 
                  FROM Freeorder INNER JOIN Customer INNER JOIN Service
                  ON Freeorder.id_customer = Customer.id_customer AND Freeorder.id_service = Service.id_service
                  WHERE
                  Customer.first_and_last_name LIKE '%$search%' OR
                  Service.name_service LIKE '%$search%' OR
                  Freeorder.date_of_visit LIKE '%$search%' OR
                  Freeorder.time_of_visit LIKE '%$search%'";

    }
    else
    {
     $query = "SELECT 
                    Freeorder.id_free_order, 
                    Customer.first_and_last_name, 
                    Service.name_service, 
                    Freeorder.date_of_visit, 
                    Freeorder.time_of_visit 
               FROM Freeorder INNER JOIN Customer INNER JOIN Service
               ON Freeorder.id_customer = Customer.id_customer AND Freeorder.id_service = Service.id_service";
    }



 

    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $output .= '
            <table id="myTable" class="freeorder_table">
                <thead> 
                <tr id="point_cursor">
                    <th onclick="sortTable(0)">Фамилия и Имя Клиента</th>
                    <th onclick="sortTable(1)">Название услуги</th>
                    <th onclick="sortTable(2)">Дата посещения</th>
                    <th onclick="sortTable(3)">Время посещения</th>
                    
                    <th></th>
                </tr>

            </thead>
           
            <tbody>
            
        ';
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
    
          
            <tr>
                <td>'.$row["first_and_last_name"].'</td>
                <td>'.$row["name_service"].'</td>
                <td>'.$row["date_of_visit"].'</td>
                <td>'.$row["time_of_visit"].'</td>

                <td>
                <form method="post" action="/admin/freeorder/freeorder_edit.php">
                    <input type="hidden" name="edit_id"  value="'.$row["id_free_order"].'">
                    <input type="submit" name="edit_btn" value="Распределить" class="rectangle_btn btn_gray">
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