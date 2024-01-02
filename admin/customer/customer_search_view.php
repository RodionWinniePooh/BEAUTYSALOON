<?php
require_once('../db_connection.php');


    if(isset($_POST["query"]))
    {
        $search = mysqli_real_escape_string($connect, $_POST["query"]);

        $query = "SELECT `id_customer`, `email`, `phone_number`, `first_and_last_name`, `customer_discount` 
                  FROM `customer` 
                  WHERE 
                  `email` LIKE '%$search%' OR 
                  `phone_number`   LIKE '%$search%' OR
                  `first_and_last_name` LIKE '%$search%' OR
                  `customer_discount` LIKE '%$search%'
                  ";

    }
    else
    {
     $query = "SELECT `id_customer`, `email`, `phone_number`, `first_and_last_name`, `customer_discount` 
               FROM `customer`";
    }





    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $output .= '
            <table id="myTable" class="customer_table">
                <thead> 
                <tr id="point_cursor">
                    <th onclick="sortTable(0)">Email</th>
                    <th onclick="sortTable(2)">Телефон</th>
                    <th onclick="sortTable(3)">Фамилия и Имя</th>
                    <th onclick="sortTable(4)">Скидка</th>
                    
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
                <td>'.$row["email"].'</td>
                <td><a href="tel:+375'.$row["phone_number"].'">'.$row["phone_number"].'</a></td>
                <td>'.$row["first_and_last_name"].'</td>
                <td>'.$row["customer_discount"].'%</td>
                <td>
                    <form method="post" action="/admin/customer/customer_edit.php">
                        <input type="hidden" name="edit_id"  value="'.$row["id_customer"].'">
                        <input type="submit" name="edit_btn" value="Редактировать" class="rectangle_btn btn_gray">
                    </form>

                </td>
                <td>
                    <form method="post" action="/admin/query_delete.php">
                        <input type="hidden" name="delete_id" value="'.$row['id_customer'].'">
                        <input type="submit" name="delete_btn_customer" value="Удалить" class="rectangle_btn btn_red">
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