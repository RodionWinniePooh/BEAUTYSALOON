<?php 
session_start();
require_once "start.php";
$connect = mysqli_connect("localhost", "root", "", "beautysaloon");

if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM `service` WHERE id_service = '$id'";
    $result = mysqli_query($connect, $query);

    if($result)
    {
        $_SESSION['success'] = "Ваши данные были удалены";
        header('Location: /admin/service/service.php');
    }
    else
    {
        $_SESSION['status'] = "Ваши данные не были удалены";
        header('Location: /admin/service/service.php');
    }
}

if(isset($_POST['delete_service']))
{
    $delete_name_service = mysqli_real_escape_string($connect, trim($_POST['delete_name_service']));

    $query ="DELETE FROM service WHERE name_service = '$delete_name_service'";

    $result = mysqli_query($connect, $query);
    if($result)
    {
        $_SESSION['success'] = "Ваши данные были удалены";
        header('Location: /admin/service/service.php');
    }
    else
    {
        $_SESSION['status'] = "Ваши данные не были удалены";
        header('Location: /admin/service/service.php');
    }
}

if(isset($_POST['delete_employee']))
{
    $delete_full_name_employee = mysqli_real_escape_string($connect, trim($_POST['delete_full_name_employee']));

    $query = "DELETE FROM employee WHERE full_name = '$delete_full_name_employee'";

    $result = mysqli_query($connect, $query);
    if($result)
    {
        $_SESSION['success'] = "Ваши данные были удалены";
        header('Location: /admin/employee/employee.php');
    }
    else
    {
        $_SESSION['status'] = "Ваши данные не были удалены";
        header('Location: /admin/employee/employee.php');
    }

}

if(isset($_POST['delete_btn_employee']))
{
    $id = $_POST['delete_id'];

    $query_free_order = "SELECT id_customer, id_service, date_of_visit, time_of_visit  
                                FROM Visit 
                                WHERE id_employee = '$id' AND service_provided = false"; 
    //Получаем все записи которые не выполнини сотрудние перед удалением его из базы данных

    $result_free_order = mysqli_query($connect, $query_free_order);
    if($result_free_order)
    {
        while($row = mysqli_fetch_array($result_free_order))
        {
            $query_add_free_order = "INSERT INTO freeorder (id_customer, id_service, date_of_visit, time_of_visit)
                                     VALUES ('".$row['id_customer']."', '".$row['id_service']."', '".$row['date_of_visit']."', '".$row['time_of_visit']."')";

            $result_add_free_order = mysqli_query($connect, $query_add_free_order);
        }
    }



    $query = "DELETE FROM `employee` WHERE id_employee = '$id'";
    $result = mysqli_query($connect, $query);

    if($result)
    {
        $_SESSION['success'] = "Ваши данные были удалены";
        header('Location: /admin/employee/employee.php');
    }
    else
    {
        $_SESSION['status'] = "Ваши данные не были удалены";
        header('Location: /admin/employee/employee.php');
    }
}

if(isset($_POST['delete_material']))
{
    $delete_name_material         = mysqli_real_escape_string($connect, trim($_POST['delete_name_material']));
    $delete_material_manufacturer = mysqli_real_escape_string($connect, trim($_POST['delete_material_manufacturer']));

    $query = "DELETE FROM material WHERE name_material = '$delete_name_material' AND manufacturer = '$delete_material_manufacturer'";

    $result = mysqli_query($connect, $query);
    if($result)
    {
        $_SESSION['success'] = "Ваши данные были удалены";
        header('Location: /admin/material/material.php');
    }
    else
    {
        $_SESSION['status'] = "Ваши данные не были удалены";
        header('Location: /admin/material/material.php');
    }
}

if(isset($_POST['delete_btn_material']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM `material` WHERE id_material = '$id'";
    $result = mysqli_query($connect, $query);

    if($result)
    {
        $_SESSION['success'] = "Ваши данные были удалены";
        header('Location: /admin/material/material.php');
    }
    else
    {
        $_SESSION['status'] = "Ваши данные не были удалены";
        header('Location: /admin/material/material.php');
    }
}


if(isset($_POST['delete_customer']))
{
    $delete_phone_number = mysqli_real_escape_string($connect, trim($_POST['delete_phone_number']));

    $query = "DELETE FROM customer WHERE phone_number = '$delete_phone_number'";

    $result = mysqli_query($connect, $query);
    if($result)
    {
        $_SESSION['success'] = "Ваши данные были удалены";
        header('Location: /admin/customer/customer.php');
    }
    else
    {
        $_SESSION['status'] = "Ваши данные не были удалены";
        header('Location: /admin/customer/customer.php');
    }
}

if(isset($_POST['delete_btn_customer']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM `customer` WHERE id_customer = '$id'";
    $result = mysqli_query($connect, $query);

    if($result)
    {
        $_SESSION['success'] = "Ваши данные были удалены";
        header('Location: /admin/customer/customer.php');
    }
    else
    {
        $_SESSION['status'] = "Ваши данные не были удалены";
        header('Location: /admin/customer/customer.php');
    }
}





?>