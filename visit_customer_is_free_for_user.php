<?php
session_start();
//require_once "start.php";

    $connect = mysqli_connect("localhost", "root", "", "beautysaloon");
    $output = '';
    $query = '';

    error_reporting(0);

    if(isset($_POST["time"]) && isset($_POST["date"]))
    {
         
        $time = mysqli_real_escape_string($connect, $_POST["time"]);
        $date = mysqli_real_escape_string($connect, $_POST["date"]);

        $query = "SELECT full_name 
        from Employee  
		where full_name not in
        (
            (select full_name from Employee inner join Visit 
                on Employee.id_employee = Visit.id_employee
                where  Visit.date_of_visit = '$date' and Visit.time_of_visit = '$time'
                group by full_name))
        group by full_name";

        $result = mysqli_query($connect, $query);
            
        while ($row = mysqli_fetch_row($result)) {
            echo "<option>$row[0]</option>";
        }
        
    }



?>