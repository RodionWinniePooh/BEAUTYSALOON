<?php
session_start();
require_once "../start.php";

    $connect = mysqli_connect("localhost", "root", "", "beautysaloon");
    $output = '';
    $query = '';


    if(isset($_POST["query"]))
    {
        $search = mysqli_real_escape_string($connect, $_POST["query"]);

        $query = "SELECT `id_material`, `name_material`, `unit`, `quantity`, `manufacturer` 
                  FROM `material` 
                  WHERE 
                  `name_material` LIKE '%$search%' OR 
                  `unit`      LIKE '%$search%' OR
                  `quantity`   LIKE '%$search%' OR
                  `manufacturer` LIKE '%$search%'
                  ";

    }
    else
    {
     $query = "SELECT `id_material`, `name_material`, `unit`, `quantity`, `manufacturer` 
               FROM `material`";
    }


    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $output .= '
            <table id="myTable" class="material_table">
                <thead> 
                <tr id="point_cursor">
                    <th onclick="sortTable(0)">Название материала</th>
                    <th onclick="sortTable(1)">Единицы измерения</th>
                    <th onclick="sortTable(2)">Количество</th>
                    <th onclick="sortTable(3)">Производитель</th>
                    
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
                <td>'.$row["name_material"].'</td>
                <td>'.$row["unit"].'</td>
                <td>'.$row["quantity"].'</td>
                <td>'.$row["manufacturer"].'</td>
                <td>
                    <form method="post" action="/admin/material/material_edit.php">
                        <input type="hidden" name="edit_id"  value="'.$row["id_material"].'">
                        <input type="submit" name="edit_btn" value="Редактировать" class="rectangle_btn btn_gray">
                    </form>

                </td>
                <td>
                    <form method="post" action="/admin/query_delete.php">
                        <input type="hidden" name="delete_id" value="'.$row['id_material'].'">
                        <input type="submit" name="delete_btn_material" value="Удалить" class="rectangle_btn btn_red">
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
        echo '<h2 class="warning" style="margin:10px;">Данные не найдены</h2>';
    }

?>