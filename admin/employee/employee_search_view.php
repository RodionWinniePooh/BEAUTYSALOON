<?php
session_start();
require_once "../start.php";

    $connect = mysqli_connect("localhost", "root", "", "beautysaloon");
    $output = '';
    $query = '';


    if(isset($_POST["query"]))
    {
        $search = mysqli_real_escape_string($connect, $_POST["query"]);

        $query = "SELECT `id_employee`, `full_name`, `address`, `phone_number`, `length_of_work`, `rank_of_master`, `date_of_employment`, `bonus_percentage` 
                  FROM `employee` 
                  WHERE 
                  `full_name` LIKE '%$search%' OR
                  `address`   LIKE '%$search%' OR
                  `phone_number` LIKE '%$search%' OR
                  `length_of_work` LIKE '%$search%' OR 
                  `rank_of_master` LIKE '%$search%' OR 
                  `date_of_employment` LIKE '%$search%' OR
                  `bonus_percentage` LIKE '%$search%'
                  ";

    }
    else
    {
     $query = "SELECT `id_employee`, `full_name`, `address`, `phone_number`, `length_of_work`, `rank_of_master`, `date_of_employment`, `bonus_percentage` 
               FROM `employee`";
    }



 

    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $output .= '
            <table id="myTable" class="employee_table">
                <thead> 
                <tr id="point_cursor">
                    <th onclick="sortTable(0)">ФИО</th>
                    <th onclick="sortTable(1)">Адрес</th>
                    <th onclick="sortTable(2)">Телефон</th>
                    <th onclick="sortTable(3)">Стаж работы</th>
                    <th onclick="sortTable(4)">Разряд сотрудника</th>
                    <th onclick="sortTable(5)">Дата приёма на работу</th>
                    <th onclick="sortTable(6)">Процент надбавки</th>
                    
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
                <td>'.$row["full_name"].'</td>
                <td>'.$row["address"].'</td>
                <td><a href="tel:+375'.$row["phone_number"].'">'.$row["phone_number"].'</a></td>
                <td>'.$row["length_of_work"].'</td>
                <td>'.$row["rank_of_master"].'</td>
                <td>'.$row["date_of_employment"].'</td>
                <td>'.$row["bonus_percentage"].'%</td>
                <td>
                    <form method="post" action="/admin/employee/employee_edit.php">
                        <input type="hidden" name="edit_id"  value="'.$row["id_employee"].'">
                        <input type="submit" name="edit_btn" value="Редактировать" class="rectangle_btn btn_gray">
                    </form>

                </td>
                <td>
                    <form method="post" action="/admin/query_delete.php">
                        <input type="hidden" name="delete_id" value="'.$row['id_employee'].'">
                        <input type="submit" name="delete_btn_employee" value="Удалить" class="rectangle_btn btn_red">
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