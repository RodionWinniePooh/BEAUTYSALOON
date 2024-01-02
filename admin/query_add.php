<?
session_start();
//require_once "start.php";
$connect = mysqli_connect("localhost", "root", "", "beautysaloon");

if(isset($_POST['add_service']))
{
    $name_service = mysqli_real_escape_string($connect, trim($_POST['name_service']));
    $price = mysqli_real_escape_string($connect, trim($_POST['price']));
    $description_service = mysqli_real_escape_string($connect, trim($_POST['description_service']));
    $category = mysqli_real_escape_string($connect, trim($_POST['category']));
    $duration_service = mysqli_real_escape_string($connect, trim($_POST['duration_service']));
    
    $query_name_service = "SELECT * FROM service WHERE name_service = '$name_service'";
    $result_name_service = mysqli_query($connect, $query_name_service);

    if(mysqli_num_rows($result_name_service) == 0) {
        $query ="INSERT INTO service (name_service, price, description_service, category, duration_service) 
                 VALUES ( '$name_service', '$price', '$description_service', '$category', '$duration_service')";

        $result = mysqli_query($connect, $query);
        if($result)
        {
            $_SESSION['success'] = "Ваши данные были добавлены";
            header('Location: /admin/service/service.php');
        }
        else
        {
            $_SESSION['status'] = "Ваши данные не были добавлены";
            header('Location: /admin/service/service.php');
        } 
    }
    else{
        $_SESSION['success'] = "Услуга с таким названием уже существует";
        header('Location: /admin/service/service.php');
    }
   
              
}

if(isset($_POST['add_employee']))
{
    $full_name = mysqli_real_escape_string($connect, trim($_POST['full_name']));
    $address = mysqli_real_escape_string($connect, trim($_POST['address']));
    $phone_number = mysqli_real_escape_string($connect, trim($_POST['phone_number']));
    $length_of_work = mysqli_real_escape_string($connect, trim($_POST['length_of_work']));
    $rank_of_master = mysqli_real_escape_string($connect, trim($_POST['rank_of_master']));
    $date_of_employment = mysqli_real_escape_string($connect, trim($_POST['date_of_employment']));

    $query_full_name = "SELECT * from employee WHERE full_name = '$full_name'";
    $result_full_name = mysqli_query($connect, $query_full_name);

    if(mysqli_num_rows($result_full_name) == 0) {
        $query = "INSERT INTO employee (full_name, address, phone_number, length_of_work, rank_of_master, date_of_employment)
                  VALUES ('$full_name', '$address', '$phone_number', '$length_of_work', '$rank_of_master', '$date_of_employment')";
        $result = mysqli_query($connect, $query);

        if($result)
        {
          $_SESSION['success'] = "Ваши данные были добавлены ";
          header('Location: /admin/employee/employee.php');
        }
        else
        {
          $_SESSION['status'] = "Ваши данные не были добавлены";
          header('Location: /admin/employee/employee.php');
        }
    }
    else {
        $_SESSION['success'] = "Сотрудник с таким ФИО уже существует";
        header('Location: /admin/employee/employee.php');
    }
}

if(isset($_POST['add_customer']))
{
    $email = mysqli_real_escape_string($connect, trim($_POST['email']));
    $phone_number = mysqli_real_escape_string($connect, trim($_POST['phone_number']));
    $first_and_last_name = mysqli_real_escape_string($connect, trim($_POST['first_and_last_name']));

    $query_phone_number = "SELECT * from customer WHERE phone_number = '$phone_number'";
    $result_phone_number = mysqli_query($connect, $query_phone_number);


    if(mysqli_num_rows($result_phone_number) == 0) {

        $query = "INSERT INTO customer (email, phone_number, first_and_last_name)
                  VALUES ('$email', '$phone_number', '$first_and_last_name')";
        $result = mysqli_query($connect, $query);
        if($result)
        {
            $_SESSION['success'] = "Ваши данные были добавлены";
            header('Location: /admin/customer/customer.php');
        }
        else
        {
            $_SESSION['status'] = "Ваши данные не были добавлены";
            header('Location: /admin/customer/customer.php');
        }
    }
    else{
        $_SESSION['success'] = "Клиент с таким номером телефона уже существует";
        header('Location: /admin/customer/customer.php');       
    }
}

if(isset($_POST['add_material']))
{
    $name_material = mysqli_real_escape_string($connect, trim($_POST['name_material']));
    $unit = mysqli_real_escape_string($connect, trim($_POST['unit']));
    $quantity = mysqli_real_escape_string($connect, trim($_POST['quantity']));
    $manufacturer = mysqli_real_escape_string($connect, trim($_POST['manufacturer']));

    $query_name_and_manufacturer = "SELECT * from material WHERE name_material = '$name_material' AND manufacturer = '$manufacturer'";
    $result_name_and_manufacturer = mysqli_query($connect, $query_name_and_manufacturer);

    if(mysqli_num_rows($result_name_and_manufacturer) == 0) {
        $query = "INSERT INTO material (name_material, unit, quantity, manufacturer)
                  VALUES ('$name_material', '$unit', '$quantity', '$manufacturer')";
        $result = mysqli_query($connect, $query);

        if($result)
        {
          $_SESSION['success'] = "Ваши данные были добавлены успешно";
          header('Location: /admin/material/material.php');
        }
        else
        {
          $_SESSION['error'] = "Ваши данные не были добавлены";
          header('Location: /admin/material/material.php');
        }
    }
    else {
        $_SESSION['warning'] = "Материал с таким названием и производителем уже существует";
        header('Location: /admin/material/material.php');
    }
}

if(isset($_POST['add_consumptionmaterial']))
{
    $name_material         = mysqli_real_escape_string($connect, trim($_POST['name_material']));
    $consumed_quantity     = mysqli_real_escape_string($connect, trim($_POST['consumed_quantity']));
    $material_manufacturer = mysqli_real_escape_string($connect, trim($_POST['material_manufacturer']));

        $query_quantity = "SELECT Material.quantity FROM material 
                            WHERE name_material ='$name_material' AND Material.manufacturer = '$material_manufacturer'
                            group by Material.name_material";
        $result_quantity = mysqli_query($connect, $query_quantity);

        if(mysqli_num_rows($result_quantity) != 0) {

            $quantity = '';
            while ($row = mysqli_fetch_row($result_quantity)) {
                $quantity =  $row[0];
            }

            if($quantity < $consumed_quantity){
                $_SESSION['warning'] = "Количество на складе меньше нужного";
                header('Location: /admin/consumptionmaterial/consumptionmaterial.php');
            }
            else{
                $query_update_material = "
                    UPDATE Material 
                    SET Material.quantity = Material.quantity - '$consumed_quantity' 
                    WHERE id_material = (
                        SELECT id_material 
                        FROM (
                            SELECT id_material 
                            FROM material 
                            WHERE name_material ='$name_material' AND manufacturer = '$material_manufacturer' 
                            GROUP BY name_material
                        ) AS subquery
                    ) AND Material.manufacturer = '$material_manufacturer'
                ";

                $result_update = mysqli_query($connect, $query_update_material);

                $query = "INSERT INTO consumptionmaterial (id_material, date_consumption, consumed_quantity)
                VALUES (
                        (SELECT id_material  FROM material WHERE name_material ='$name_material' AND manufacturer = '$material_manufacturer'),
                        Now(),
                        '$consumed_quantity')";

                $result = mysqli_query($connect, $query);
                
                if($result)
                {
                  $_SESSION['success'] = "Ваши данные были добавлены";
                }
                else
                {
                  $_SESSION['error'] = "Ваши данные не были добавлены $query_update_material";
                }
                header('Location: /admin/consumptionmaterial/consumptionmaterial.php');
            }
        }
}

if(isset($_POST['add_visit_through_freeorder']))
{
    $id = $_POST['edit_id'];

    $name_service = mysqli_real_escape_string($connect, trim($_POST['name_service']));
    $first_and_last_name = mysqli_real_escape_string($connect, trim($_POST['first_and_last_name']));
    $full_name_employee = mysqli_real_escape_string($connect, trim($_POST['full_name_employee']));
    $date_of_visit = mysqli_real_escape_string($connect, trim($_POST['date_of_visit']));
    $time_of_visit = mysqli_real_escape_string($connect, trim($_POST['time_of_visit']));

    $query_employee_is_free = "SELECT * FROM visit INNER JOIN employee ON Visit.id_employee = Employee.id_employee 
                                    WHERE 
                                    Visit.time_of_visit = '$time_of_visit' AND
                                    Visit.date_of_visit = '$date_of_visit' AND
                                    Employee.full_name = '$full_name_employee'";
    $result_employee_is_free = mysqli_query($connect, $query_employee_is_free);

    if(mysqli_num_rows($result_employee_is_free) == 0) {
        $query = "INSERT INTO visit (id_service, id_customer, date_of_visit, id_employee, time_of_visit)
        VALUES (
              (SELECT id_service  FROM service  WHERE name_service='$name_service'),
              (SELECT id_customer FROM customer WHERE first_and_last_name='$first_and_last_name'),
              '$date_of_visit',
              (SELECT id_employee FROM employee WHERE full_name='$full_name_employee'),
              '$time_of_visit')";
        $result = mysqli_query($connect, $query);

        if($result)
        {
          $query_delete_freeorder = "DELETE FROM freeorder WHERE id_free_order = '$id'";
          $result_delete_freeorder = mysqli_query($connect, $query_delete_freeorder);
      
          $_SESSION['success'] = "Ваши данные были добавлены";
          header('Location: /admin/freeorder/freeorder.php');
        }
        else
        {
          $_SESSION['error'] = "Ваши данные не были добавлены $query";
          header('Location: /admin/freeorder/freeorder.php');
        }
    }
}


if(isset($_POST['add_visit']))
{
    $name_service = mysqli_real_escape_string($connect, trim($_POST['name_service']));
    $first_and_last_name = mysqli_real_escape_string($connect, trim($_POST['first_and_last_name']));
    $full_name_employee = mysqli_real_escape_string($connect, trim($_POST['full_name_employee']));
    $date_of_visit = mysqli_real_escape_string($connect, trim($_POST['date_of_visit']));
    $time_of_visit = mysqli_real_escape_string($connect, trim($_POST['time_of_visit']));


    //Если сотрудник свободен
    $query_employee_is_free = "SELECT * FROM visit INNER JOIN employee ON Visit.id_employee = Employee.id_employee 
                                WHERE 
                                Visit.time_of_visit = '$time_of_visit' AND
                                Visit.date_of_visit = '$date_of_visit' AND
                                Employee.full_name = '$full_name_employee'";

    //Проверяем на наличие ошибок запрос
    $result_employee_is_free = mysqli_query($connect, $query_employee_is_free); 

    //Если в таблице сотрудники не было найдено сотрудника у которого есть запись на данное время
    //то идём дальше
    if(mysqli_num_rows($result_employee_is_free) == 0) {
        $query = "INSERT INTO visit (id_service, id_customer, date_of_visit, id_employee, time_of_visit)
        VALUES (
              (SELECT id_service  FROM service  WHERE name_service='$name_service'),
              (SELECT id_customer FROM customer WHERE first_and_last_name='$first_and_last_name'),
              '$date_of_visit',
              (SELECT id_employee FROM employee WHERE full_name='$full_name_employee'),
              '$time_of_visit')";
        $result = mysqli_query($connect, $query);

        if($result)
        {
          $_SESSION['success'] = "Ваши данные были добавлены";
        }
        else
        {
          $_SESSION['error'] = "Ваши данные не были добавлены";
        }
        header('Location: /admin/visit/visit.php');
    }
}


if(isset($_POST['add_visit_user']))
{
    $phone_number = mysqli_real_escape_string($connect, trim($_POST['phone_number']));
    $name_service = mysqli_real_escape_string($connect, trim($_POST['name_service']));
    //$first_and_last_name = mysqli_real_escape_string($connect, trim($_POST['first_and_last_name']));
    $full_name_employee = mysqli_real_escape_string($connect, trim($_POST['full_name_employee']));
    $date_of_visit = mysqli_real_escape_string($connect, trim($_POST['date_of_visit']));
    $time_of_visit = mysqli_real_escape_string($connect, trim($_POST['time_of_visit']));

    $query_phone_number = "SELECT * from customer WHERE phone_number = '$phone_number'"; //Проверка что бы не было повторяющихся номеров
    $result_phone_number = mysqli_query($connect, $query_phone_number);

    if(mysqli_num_rows($result_phone_number) == 0) {

        $query = "INSERT INTO customer (phone_number)
                  VALUES ('$phone_number')";
        $result = mysqli_query($connect, $query);
        
            //Если сотрудник свободен
        $query_employee_is_free = "SELECT * FROM visit INNER JOIN employee ON Visit.id_employee = Employee.id_employee 
                                    WHERE 
                                    Visit.time_of_visit = '$time_of_visit' AND
                                    Visit.date_of_visit = '$date_of_visit' AND
                                    Employee.full_name = '$full_name_employee'";

        //Проверяем на наличие ошибок запрос
        $result_employee_is_free = mysqli_query($connect, $query_employee_is_free); 

        //Если в таблице сотрудники не было найдено сотрудника у которого есть запись на данное время
        //то идём дальше
        if(mysqli_num_rows($result_employee_is_free) == 0) {
            $query = "INSERT INTO visit (id_service, id_customer, date_of_visit, id_employee, time_of_visit)
            VALUES (
                  (SELECT id_service  FROM service  WHERE name_service='$name_service'),
                  (SELECT id_customer FROM customer WHERE phone_number='$phone_number'),
                  '$date_of_visit',
                  (SELECT id_employee FROM employee WHERE full_name='$full_name_employee'),
                  '$time_of_visit')";
            $result = mysqli_query($connect, $query);

            if($result)
            {
              $_SESSION['success'] = '<script>
                                        setTimeout(function(){
                                        alert( "Запись прошла успешно" );
                                        }, 50);
                                    </script>';
            }
            else
            {
              $_SESSION['error'] = '<script>
                                        setTimeout(function(){
                                        alert( "Ваши данные не были добавлены, проверьте правильность вводимых данных" );
                                        }, 50);
                                    </script>';
            }
            header('Location: /');
        }
    }

    if(mysqli_num_rows($result_phone_number) == 1) {
        
            //Если сотрудник свободен
        $query_employee_is_free = "SELECT * FROM visit INNER JOIN employee ON Visit.id_employee = Employee.id_employee 
                                    WHERE 
                                    Visit.time_of_visit = '$time_of_visit' AND
                                    Visit.date_of_visit = '$date_of_visit' AND
                                    Employee.full_name = '$full_name_employee'";

        //Проверяем на наличие ошибок запрос
        $result_employee_is_free = mysqli_query($connect, $query_employee_is_free); 

        //Если в таблице сотрудники не было найдено сотрудника у которого есть запись на данное время
        //то идём дальше
        if(mysqli_num_rows($result_employee_is_free) == 0) {
            $query = "INSERT INTO visit (id_service, id_customer, date_of_visit, id_employee, time_of_visit)
            VALUES (
                  (SELECT id_service  FROM service  WHERE name_service='$name_service'),
                  (SELECT id_customer FROM customer WHERE phone_number='$phone_number'),
                  '$date_of_visit',
                  (SELECT id_employee FROM employee WHERE full_name='$full_name_employee'),
                  '$time_of_visit')";
            $result = mysqli_query($connect, $query);

            if($result)
            {
              $_SESSION['success'] = '<script>
                                        setTimeout(function(){
                                        alert( "Запись прошла успешно" );
                                        }, 50);
                                    </script>';
            }
            else
            {
              $_SESSION['error'] = '<script>
                                        setTimeout(function(){
                                        alert( "Ваши данные не были добавлены, проверьте правильность вводимых данных" );
                                        }, 50);
                                    </script>';
            }
            header('Location: /');
        }
    }
    // else{


    //     //echo '<script>alert("ghbdtn");</script>';
    //     $_SESSION['success'] = '<script>
    //                                 setTimeout(function(){
    //                                     alert( "Клиент с таким номером телефона уже существует" );
    //                                 }, 50);
    //                             </script>';
    //     header('Location: /');       
    // }

}

if(isset($_POST['button_auth'])) {
    $index_location = "Location: /";

    $phone_number_user  = mysqli_real_escape_string($connect, trim($_POST['phone_number_user']));
    $pass_user          = mysqli_real_escape_string($connect, trim($_POST['pass_user']));

    if(!empty($phone_number_user) && !empty($pass_user)) {
        // $query_login = "SELECT `phone_number` , `pass` FROM `customer` WHERE phone_number = '$phone_number_user' AND pass != md5('$pass_user')";
        // $result_login = mysqli_query($connect, $query_login);

        // if(mysqli_num_rows($result_login) == 0){
        //     $_SESSION['success'] = '<script>
        //                                 setTimeout(function(){
        //                                 alert( "Пароль введён неверно" );
        //                                 }, 50);
        //                             </script>';
        //     header($index_location);
        // }

        $query = "SELECT `phone_number` , `pass` FROM `customer` WHERE phone_number = '$phone_number_user' AND pass = md5('$pass_user')";

        $data = mysqli_query($connect,$query);
        if(mysqli_num_rows($data) == 1) {

            //$row = mysqli_fetch_assoc($data);
            $_SESSION["login_user"] = $phone_number_user;
            $_SESSION["pass_user"] = $pass_user;

            header('Location: /myprofile.php');
            //exit;
            //setcookie('user_id', $row['user_id'], time() + (60*60*24*30));
            //setcookie('username', $row['username'], time() + (60*60*24*30));
        }
        else {
            $_SESSION['warning'] = '<script>
                                        setTimeout(function(){
                                        alert( "Извините, вы должны ввести правильное имя и/или пароль" );
                                        }, 50);
                                    </script>';
            header($index_location);

        }
      }

}


if(isset($_POST['add_customer_user']))
{
    $email = mysqli_real_escape_string($connect, trim($_POST['email']));
    $phone_number = mysqli_real_escape_string($connect, trim($_POST['phone_number']));
    $first_and_last_name = mysqli_real_escape_string($connect, trim($_POST['first_and_last_name']));
    $pass_up = mysqli_real_escape_string($connect, trim($_POST['pass_up']));

    $query_phone_number = "SELECT * from customer WHERE phone_number = '$phone_number'";
    $result_phone_number = mysqli_query($connect, $query_phone_number);


    if(mysqli_num_rows($result_phone_number) == 0) {

        $query = "INSERT INTO customer (email, phone_number, first_and_last_name, pass)
                  VALUES ('$email', '$phone_number', '$first_and_last_name', '$pass_up')";
        $result = mysqli_query($connect, $query);
        if($result)
        {
            $_SESSION['success'] = '<script>
                                        setTimeout(function(){
                                        alert( "Регистрация прошла успшено" );
                                        }, 50);
                                    </script>';
            header('Location: /');
        }
        else
        {
            $_SESSION['success'] = '<script>
                                        setTimeout(function(){
                                        alert( "Ваши данные не были добавлены" );
                                        }, 50);
                                    </script>';
            header('Location: /');
        }
    }
    else{
        $_SESSION['success'] = '<script>
                                    setTimeout(function(){
                                    alert( "Клиент с таким номером телефона уже существует" );
                                    }, 50);
                                </script>';
        header('Location: /');       
    }
}

?>