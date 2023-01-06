<?php
session_start();
require_once "../start.php";

    $connect = mysqli_connect("localhost", "root", "", "beautysaloon");
    $output = '';
    $query = '';


    if(isset($_POST["query"]))
    {
        $search = mysqli_real_escape_string($connect, $_POST["query"]);

        $query = "SELECT `id_service`, `name_service`, `price`, `description_service`, `category`, `duration_service` 
                  FROM `service` 
                  WHERE 
                  `name_service` LIKE '%$search%' OR `price` LIKE '%$search%' OR `category` LIKE '%$search%' OR `duration_service` LIKE '%$search%'
                  ";

    }
    else
    {
     $query = "SELECT `id_service`, `name_service`, `price`, `description_service`, `category`, `duration_service` 
               FROM `service`";
    }



 

    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $output .= '
            <table id="myTable" class="service_table">
                
                <thead> 
                <tr id="point_cursor">
                    <th onclick="sortTable(0)">Название услуги</th>
                    <th onclick="sortTable(1)">Цена</th>
                    <th onclick="sortTable(2)">Описание услуги</th>
                    <th onclick="sortTable(3)">Категория</th>
                    <th onclick="sortTable(4)">Длительность услуги</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
           
            <tbody>
            
        ';
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
    
          
            <tr>
                <td>'.$row["name_service"].'</td>
                <td>'.$row["price"].'</td>
                <td>'.$row["description_service"].'</td>
                <td>'.$row["category"].'</td>
                <td>'.$row["duration_service"].'</td>
                <td>
                    <form method="post" action="service_edit.php">
                        <input type="hidden" name="edit_id"  value="'.$row["id_service"].'">
                        <input type="submit" name="edit_btn" value="Редактировать" class="rectangle_btn btn_gray">
                    </form>

                </td>
                <td>
                    <form method="post" action="/admin/query_delete.php">
                        <input type="hidden" name="delete_id" value="'.$row['id_service'].'">
                        <input type="submit" name="delete_btn" value="Удалить" class="rectangle_btn btn_red">
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