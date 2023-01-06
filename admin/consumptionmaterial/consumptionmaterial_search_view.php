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
                    ConsumptionMaterial.id_consumption,
                    Material.manufacturer,
                    Material.name_material,
                    ConsumptionMaterial.date_consumption,
                    ConsumptionMaterial.consumed_quantity 
                  FROM Material INNER JOIN ConsumptionMaterial 
                  ON Material.id_material = ConsumptionMaterial.id_consumption
                  WHERE
                    Material.manufacturer LIKE '%$search%' OR
                    Material.name_material LIKE '%$search%' OR
                    ConsumptionMaterial.date_consumption LIKE '%$search%' OR
                    ConsumptionMaterial.consumed_quantity LIKE '%$search%'";

    }
    else
    {

    
     $query = "SELECT ConsumptionMaterial.id_consumption,
                      Material.name_material,
                      Material.manufacturer,
                      ConsumptionMaterial.date_consumption,
                      ConsumptionMaterial.consumed_quantity 
               FROM Material INNER JOIN ConsumptionMaterial 
               ON Material.id_material = ConsumptionMaterial.id_material";
    }



 

    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $output .= '
            <table id="myTable" class="material_table">
                <thead> 
                <tr id="point_cursor">
                    <th onclick="sortTable(0)">Название материала</th>
                    <th onclick="sortTable(1)">Производитель</th>
                    <th onclick="sortTable(2)">Дата и время</th>
                    <th onclick="sortTable(3)">Количество требуемого материала</th>

                </tr>
            </thead>
           
            <tbody>
            
        ';
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
    
          
            <tr>
                <td>'.$row["name_material"].'</td>
                <td>'.$row["manufacturer"].'</td>
                <td>'.$row["date_consumption"].'</td>
                <td>'.$row["consumed_quantity"].'</td>
                <td>
                <form method="post" action="/admin/consumptionmaterial/consumption_edit.php">
                    <input type="hidden" name="edit_id"  value="'.$row["id_consumption"].'">
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