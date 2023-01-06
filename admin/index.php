<?php
    session_start();

    require_once "start.php";

    if(isset($_POST["button_exit"])){
        session_destroy();
        header('Location: /admin/auth.php');
        exit;
    }

    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $database   = "beautysaloon";

    $connect = mysqli_connect($servername, $username, $password, $database);

    $output = '';
    $query = '';
?>

<?php require_once "block/head.php"; ?>

<body>

    <div class="grid_main_admin">
        
        <?php 
            require_once "block/asidepanel.php";
            require_once "block/header.php";
        ?>

        <article class="text_for_first_query">
            <h2 style="margin:10px;">Записи на сегодня:</h2>
        </article>

        <article class="query_recorded_today container_table_view">

            <?php
            $query = "SELECT Employee.full_name, Customer.first_and_last_name, Visit.time_of_visit 
                      FROM Employee INNER JOIN Customer INNER JOIN Visit 
                      ON Employee.id_employee = Visit.id_employee
                      AND Customer.id_customer = Visit.id_customer WHERE Visit.date_of_visit = Date(Now())";

            $result = mysqli_query($connect, $query);

            if(mysqli_num_rows($result) > 0)
                {
                $output .= '

                    <table id="myTable" class="query_recorder_today_table query_table">
                
                        <thead> 
                        <tr id="point_cursor">
                            <th onclick="sortTable(0)">ФИО Сотрудника</th>
                            <th onclick="sortTable(1)">Имя Клиента</th>
                            <th onclick="sortTable(2)">Время посещения</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                ';
                while($row = mysqli_fetch_array($result))
                {
                    $output .= '
                
                
                    <tr>
                        <td>'.$row["full_name"].'</td>
                        <td>'.$row["first_and_last_name"].'</td>
                        <td>'.$row["time_of_visit"].'</td>
                    </tr>
                
                    ';
                }
                $output .= ' </tbody></table>';
            
                    echo $output;
            }
            else
            {
             echo '<h2 style="margin:20px;">На сегодня записей нет</h2>';
            }
            
            ?>
        </article>

        <article class="text_for_second_query">
            <h2 style="margin:10px;">Информация о сумме оказанных услуг и проценте надбавки Сотрудника, за последние 30 дней:</h2>
        </article>

        <article class="query_rendered_service container_table_view">
        <?php
            $query = "SELECT Sum(Service.price) as SumPrice, Employee.full_name, round(Sum(Service.price) * Employee.bonus_percentage / 100,2) as Allowance FROM
            Customer INNER JOIN Service INNER JOIN Employee INNER JOIN Visit 
            ON Customer.id_customer = Visit.id_customer AND Service.id_service = Visit.id_service AND Employee.id_employee = Visit.id_employee 
            WHERE  TO_DAYS(NOW()) - TO_DAYS(Visit.date_of_visit) <= 30  group by Employee.full_name";

            $result = mysqli_query($connect, $query);

            $output ='';

            if(mysqli_num_rows($result) > 0)
                {
                $output .= '

                    <table id="myTable" class="query_recorder_today_table query_table">
                
                        <thead> 
                        <tr id="point_cursor">
                            <th onclick="sortTable(0)">Оказано услуг на сумму</th>
                            <th onclick="sortTable(1)">ФИО сотрудника</th>
                            <th onclick="sortTable(2)">Сумма надбавки</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                ';
                while($row = mysqli_fetch_array($result))
                {
                    $output .= '
                
                
                    <tr>
                        <td>'.$row["SumPrice"].'</td>
                        <td>'.$row["full_name"].'</td>
                        <td>'.$row["Allowance"].'</td>
                    </tr>
                
                    ';
                }
                $output .= ' </tbody></table>';
            
                    echo $output;
            }
            else
            {
             echo '<h2 style="margin:10px;">Нету информации</h2>';
            }
            ?>
        </article>

        <article class="text_for_third_query">
            <h2 style="margin:10px;">Расход материала за последний месяц:</h2>
        </article>

        <article class="query_consumption_material">
        <?php
            $query = "SELECT Material.name_material, Consumptionmaterial.date_consumption  , sum(Consumptionmaterial.consumed_quantity) as quantity
            from material inner join Consumptionmaterial on
             Consumptionmaterial.id_material = Material.id_material where month(Consumptionmaterial.date_consumption)=month(now()) group by Material.name_material";

            $result = mysqli_query($connect, $query);

            $output ='';

            if(mysqli_num_rows($result) > 0)
                {
                $output .= '

                    <table id="myTable" class="query_recorder_today_table query_table">
                
                        <thead> 
                        <tr id="point_cursor">
                            <th onclick="sortTable(0)">Название материала</th>
                            <th onclick="sortTable(1)">Дата и время</th>
                            <th onclick="sortTable(2)">Количество израсходованного материала</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                ';
                while($row = mysqli_fetch_array($result))
                {
                    $output .= '
                
                
                    <tr>
                        <td>'.$row["name_material"].'</td>
                        <td>'.$row["date_consumption"].'</td>
                        <td>'.$row["quantity"].'</td>
                    </tr>
                
                    ';
                }
                $output .= ' </tbody></table>';
            
                    echo $output;
                    //mysqli_close($connect);
            }
            else
            {
             echo '<h2 style="margin:10px;">Нету информации</h2>';
            }
            ?>
        </article>
        <style>
            .container_table_view {
                height: 400px;
                padding: 0px;
                overflow: auto;
            }

            .query_recorder_today_table>tbody>tr>td:nth-child(1) {
                text-align:  center;
            }
            .query_recorder_today_table>tbody>tr>td:nth-child(2) {
                text-align:  center;
            }
            .query_recorder_today_table>tbody>tr>td:nth-child(3) {
                text-align:  center;
            }
        </style>


        <aside class="aside_table">
            <form>
                <ol class="widget-list">
                    <li><a href="/admin/service/service.php">     Услуги          </a></li>
                    <li><a href="/admin/employee/employee.php">            Сотрудники      </a></li>
                    <li><a href="/admin/customer/customer.php">            Клиенты         </a></li>
                    <li><a href="/admin/visit/visit.php" >               Посещения       </a></li>
                    <li><a href="/admin/material/material.php">            Материалы       </a></li>
                    <li><a href="/admin/consumptionmaterial/consumptionmaterial.php"> Расход материла </a></li>
                    <li><a href="/admin/freeorder/freeorder.php"> Свободные посещения </a></li>
                    <hr>
                    <li>
                        <table>
                        <tr>
                          <td style="vertical-align: middle"><img src="wallpaper/icon_setting.png" style="max-width:35px; min-width:10px;"></td>
                          <td style="vertical-align: middle"> <a href="/admin/setting.php">Настройки</a></td>
                        </tr>
                        </table>
                    </li>
                </ol>
            </form>  
        </aside>


        <?php 
            require_once "block/footer.php";
        ?>


    </div>



</body>
</html>