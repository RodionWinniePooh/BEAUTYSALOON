<?php
session_start();
require_once "../start.php";

    $connect = mysqli_connect("localhost", "root", "", "beautysaloon");
    $output = '';
    $query = '';

    error_reporting(0);

    if(isset($_POST["query"]))
    {
         
        $material_manufacturer = mysqli_real_escape_string($connect, $_POST["query"]);

        $query = "SELECT Material.manufacturer 
        from Material  
		where name_material = '$material_manufacturer'";

        $result = mysqli_query($connect, $query);
            
        while ($row = mysqli_fetch_row($result)) {
            echo "<option>$row[0]</option>";
        }
        
    }

?>