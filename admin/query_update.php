<?php
session_start();
require_once "start.php";
$connect = mysqli_connect("localhost", "root", "", "beautysaloon");

if(isset($_POST['update_btn_service'])){

    $id = $_POST['edit_id'];

    $edit_name_service        = mysqli_real_escape_string($connect, trim($_POST['edit_name_service']));
    $edit_price_serivce       = mysqli_real_escape_string($connect, trim($_POST['edit_price_serivce']));
    $edit_description_service = mysqli_real_escape_string($connect, trim($_POST['edit_description_service']));
    $edit_category_service    = mysqli_real_escape_string($connect, trim($_POST['edit_category_service']));
    $edit_duration_service    = mysqli_real_escape_string($connect, trim($_POST['edit_duration_service']));

    $query = "UPDATE `service`  SET  name_service        = '$edit_name_service', 
                                     price               = '$edit_price_serivce',
                                     description_service = '$edit_description_service',
                                     category            = '$edit_category_service',
                                     duration_service    = '$edit_duration_service' 
                                WHERE id_service = '$id' ";

    $result = mysqli_query($connect, $query);

    if($result)
    {
        $_SESSION['success'] = "Ваши данные были обновлены";
        header('Location: /admin/service/service.php');
    }
    else
    {
        $_SESSION['status'] = "Ваши данные не были обновлены";
        header('Location: /admin/service/service.php');
    }
}

if(isset($_POST['update_btn_employee'])){

    $id = $_POST['edit_id'];

    $edit_full_name          = mysqli_real_escape_string($connect, trim($_POST['edit_full_name']));
    $edit_address            = mysqli_real_escape_string($connect, trim($_POST['edit_address']));
    $edit_phone_number       = mysqli_real_escape_string($connect, trim($_POST['edit_phone_number']));
    $edit_length_of_work     = mysqli_real_escape_string($connect, trim($_POST['edit_length_of_work']));
    $edit_rank_of_master     = mysqli_real_escape_string($connect, trim($_POST['edit_rank_of_master']));
    $edit_date_of_employment = mysqli_real_escape_string($connect, trim($_POST['edit_date_of_employment']));




    $query = "UPDATE `employee`  SET  full_name          = '$edit_full_name', 
                                      address            = '$edit_address',
                                      phone_number       = '$edit_phone_number',
                                      length_of_work     = '$edit_length_of_work',
                                      rank_of_master     = '$edit_rank_of_master',
                                      date_of_employment = '$edit_date_of_employment'
              WHERE id_employee = '$id' ";

    $result = mysqli_query($connect, $query);

    if($result)
    {
        $_SESSION['success'] = "Ваши данные были обновлены";
        header('Location: /admin/employee/employee.php');
    }
    else
    {
        $_SESSION['status'] = "Ваши данные не были обновлены $query";
        header('Location: /admin/employee/employee.php');
    }
}

if(isset($_POST['update_btn_customer'])){

    $id = $_POST['edit_id'];

    $edit_email               = mysqli_real_escape_string($connect, trim($_POST['edit_email']));
    $edit_phone_number        = mysqli_real_escape_string($connect, trim($_POST['edit_phone_number']));
    $edit_first_and_last_name = mysqli_real_escape_string($connect, trim($_POST['edit_first_and_last_name']));


    $query = "UPDATE `customer`  SET  email               = '$edit_email',
                                      phone_number        = '$edit_phone_number',
                                      first_and_last_name = '$edit_first_and_last_name'
              WHERE id_customer = '$id' ";

    $result = mysqli_query($connect, $query);

    if($result)
    {
        $_SESSION['success'] = "Ваши данные были обновлены";
        header('Location: /admin/customer/customer.php');
    }
    else
    {
        $_SESSION['status'] = "Ваши данные не были обновлены";
        header('Location: /admin/customer/customer.php');
    }
}




if(isset($_POST['update_btn_material'])){

    $id = $_POST['edit_id'];

    $edit_name_material     = mysqli_real_escape_string($connect, trim($_POST['edit_name_material']));
    $edit_unit              = mysqli_real_escape_string($connect, trim($_POST['edit_unit']));
    $edit_quantity          = mysqli_real_escape_string($connect, trim($_POST['edit_quantity']));
    $edit_manufacturer      = mysqli_real_escape_string($connect, trim($_POST['edit_manufacturer']));


    $query = "UPDATE `material`  SET  name_material = '$edit_name_material',
                                      unit          = '$edit_unit',
                                      quantity      = '$edit_quantity',
                                      manufacturer  = '$edit_manufacturer'
              WHERE id_material = '$id'";

    $result = mysqli_query($connect, $query);

    if($result)
    {
        $_SESSION['success'] = "Ваши данные были обновлены";
        header('Location: /admin/material/material.php');
    }
    else
    {
        $_SESSION['status'] = "Ваши данные не были обновлены";
        header('Location: /admin/material/material.php');
    }
}

if(isset($_POST['service_btn'])){

    $id = $_POST['edit_id'];

    $service_provided = mysqli_real_escape_string($connect, trim($_POST['service_provided']));

    if($service_provided == 1){
        $query = "UPDATE `visit` SET `service_provided` = '$service_provided' WHERE `id_visit` = '$id' AND `date_of_visit` <= CURDATE()";
        $result = mysqli_query($connect, $query);

        if(mysqli_affected_rows($connect) > 0)
        {
            $_SESSION['success'] = "Услуга была подтверждена как 'Готова'";
            header('Location: /admin/consumptionmaterial/consumptionmaterial.php');
        }
        else
        {
            $_SESSION['error'] = "Услуга не была подтверждена как 'Готова' так дата больше текущей";
            header('Location: /admin/visit/visit.php');
        }
    }



//    if($service_provided == 1){
//        $query = "UPDATE `visit`  SET  service_provided  = '$service_provided' AND date_of_visit <= Date(Now())
//                  WHERE id_visit = '$id'";
//        $result = mysqli_query($connect, $query);
//
//        if($result)
//        {
//            $_SESSION['success'] = "Услуга была подтверждена как 'Готова'";
//            header('Location: /admin/consumptionmaterial/consumptionmaterial.php');
//        }
//        else
//        {
//
//            $_SESSION['error'] = "Услуга не была подтверждена как 'Готова' $query";
//            header('Location: /admin/visit/visit.php');
//        }
//    }

}

if(isset($_POST['update_btn_visit'])){

    $id = $_POST['edit_id'];

    $edit_first_and_last_name = mysqli_real_escape_string($connect, trim($_POST['edit_first_and_last_name']));
    $edit_name_service        = mysqli_real_escape_string($connect, trim($_POST['edit_name_service']));
    $edit_full_name_employee  = mysqli_real_escape_string($connect, trim($_POST['edit_full_name_employee']));
    $edit_date_of_visit       = mysqli_real_escape_string($connect, trim($_POST['edit_date_of_visit']));
    $edit_time_of_visit       = mysqli_real_escape_string($connect, trim($_POST['edit_time_of_visit']));

    $query = "UPDATE `visit`  SET  id_customer    = (SELECT id_customer From customer WHERE first_and_last_name = '$edit_first_and_last_name'),
                                   id_service     = (SELECT id_service From Service WHERE name_service = '$edit_name_service'),
                                   id_employee    = (SELECT id_employee From Employee WHERE full_name = '$edit_full_name_employee'),
                                   date_of_visit  = '$edit_date_of_visit',
                                   time_of_visit  =  '$edit_time_of_visit'
                              WHERE id_visit = '$id' ";

    $result = mysqli_query($connect, $query);

    if($result)
    {
        $_SESSION['success'] = "Ваши данные были обновлены";
        header('Location: /admin/visit/visit.php');
    }
    else
    {
        $_SESSION['status'] = "Ваши данные не были обновлены";
        header('Location: /admin/visit/visit.php');
    }
}


if(isset($_POST['update_btn_consumption']))
{
    $id = $_POST['edit_id'];

    $edit_name_material     = mysqli_real_escape_string($connect, trim($_POST['edit_name_material']));
    $edit_consumed_quantity = mysqli_real_escape_string($connect, trim($_POST['edit_consumed_quantity']));
    $name_material = mysqli_real_escape_string($connect, trim($_POST['name_material']));
    $consumed_quantity = mysqli_real_escape_string($connect, trim($_POST['consumed_quantity']));
    $material_manufacturer = mysqli_real_escape_string($connect, trim($_POST['material_manufacturer']));

        
        $query_quantity = "SELECT Material.quantity FROM material 
                           WHERE name_material ='$edit_name_material' AND manufacturer = '$material_manufacturer' 
                           GROUP BY name_material";
        $result_quantity = mysqli_query($connect, $query_quantity);

        if(mysqli_num_rows($result_quantity) != 0) {

            $quantity = '';
            while ($row = mysqli_fetch_row($result_quantity)) {
                $quantity =  $row[0];
            }

            if($quantity < $consumed_quantity){
                $_SESSION['success'] = "Количество на складе меньше нужного";
                header('Location: /admin/consumptionmaterial/consumptionmaterial.php');
            }
            else{
                $query_update_material = "UPDATE Consumptionmaterial SET 
                                            id_material = (SELECT id_material From material WHERE name_material = '$edit_name_material' AND manufacturer = '$material_manufacturer' group by name_material),
                                            consumed_quantity = '$edit_consumed_quantity'
                                            WHERE id_consumption = '$id'";
                $result_update_material = mysqli_query($connect, $query_update_material);              

                $query_plus_material = "UPDATE Material SET Material.quantity = Material.quantity + '$consumed_quantity' 
                                        WHERE 
                                        id_material = (SELECT id_material  FROM material WHERE name_material ='$name_material' AND manufacturer = '$material_manufacturer' group by name_material)";

                $result_plus_material = mysqli_query($connect, $query_plus_material);

                $query_minus_material = "UPDATE Material SET Material.quantity = Material.quantity - '$edit_consumed_quantity' 
                                         WHERE id_material = (SELECT id_material  FROM material WHERE name_material ='$edit_name_material' AND manufacturer = '$material_manufacturer' group by name_material)";

                $result_minus_material = mysqli_query($connect, $query_minus_material);


                
                if($result_update_material && $result_plus_material && $result_minus_material)
                {
                  $_SESSION['success'] = "Ваши данные были добавлены";
                  header('Location: /admin/consumptionmaterial/consumptionmaterial.php');
                }
                else
                {
                  $_SESSION['status'] = "Ваши данные не были добавлены";
                  header('Location: /admin/consumptionmaterial/consumptionmaterial.php');
                }
            }


        }
}

?>