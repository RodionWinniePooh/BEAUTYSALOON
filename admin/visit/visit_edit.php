<?php 
    session_start();
    require_once "../start.php";
    if(isset($_POST["button_exit"])){
        session_destroy();
        header('Location: /admin/auth.php');
        exit;
    }
    $connect = mysqli_connect("localhost", "root", "", "beautysaloon");
    $query = '';
?>

<?php require_once "../block/head.php"; ?>

<body>
    <div class="grid_edit">

    <article class="article_edit_table">

    <?php 

    if(isset($_POST['edit_btn']))
    {
        $id = $_POST['edit_id'];
        //echo $id;

        $query = "SELECT Visit.id_visit, Customer.first_and_last_name, Service.name_service, Employee.full_name, Visit.time_of_visit, Visit.date_of_visit FROM visit INNER JOIN customer INNER JOIN service INNER JOIN employee ON 
            Visit.id_customer = customer.id_customer AND Visit.id_service = Service.id_service AND Visit.id_employee = Employee.id_employee
            WHERE Visit.id_visit = '$id'";
        
        $result = mysqli_query($connect, $query);
        if(!$result){ echo 'Ошибка в подключении или в запросе'; }

        $query_name = "SELECT `first_and_last_name` FROM `customer` GROUP BY `first_and_last_name`";
        $result_name = mysqli_query($connect, $query_name); 
        $name = '';
        while ($row = mysqli_fetch_row($result_name)) {
            $name .="<option>$row[0]</option>";
        }

        $query_service = "SELECT `name_service` FROM `Service` GROUP BY `name_service`";
        $result_service = mysqli_query($connect, $query_service); 
        $service = '';
        while ($row = mysqli_fetch_row($result_service)) {
            $service .="<option>$row[0]</option>";
        }

        foreach($result as $row)
        {
            ?>

            <form method="post" action="/admin/query_update.php">
                <div>
                    <input type="hidden" name="edit_id" value="<?php echo $row['id_visit'] ?>">

                    <div>
                        <h2>Редактирование посещения</h2>
                    </div>
                    <br>
                    <form method="post" action="/admin/query_add.php">
                    <div>


                        <br>
                        <div>
                            <label>Имя и фамилия клиента:</label>
                        </div>
                        <br>
                        <div>
                            <select id="select_first_and_last_name" name="edit_first_and_last_name" class="input_min" required>
                            <?php 
                                echo $name;   
                            ?>
                            </select>
                        </div>
                        <br>
                        

                        <div>
                            <label>Услуга:</label>
                        </div>
                        <br>
                        <div>
                            <select id="select_name_service" name="edit_name_service" required class="input_min">
                                <?php 
                                    echo $service;
                                ?>
                            </select>
                            
                        </div>
                        <br>

                        <div>
                            <label>Дата посещения:</label>
                        </div>
                        <br>
                        <div>
                            <input type="date" id="DateNow" name="edit_date_of_visit" placeholder="Введите дату" class="input_min" required >
                        </div>
                        <br>
                        <div>
                            <label>Время посещения:</label>
                        </div>
                        <br>
                        <div>
                            <label>С 9:00 &nbsp</label>
                            <input type="text" id="visit" name="edit_time_of_visit" value="<?php echo $row['time_of_visit'] ?>" required pattern="(09|10|11|12|13|14|15|16|17|18|19|20|21):([3]{1}|[0]{1})[0]{1}" class="input_min" title="Минуты указывать в формате **:00 или **:30">
                            <label>До 21:30 &nbsp</label>
                                <script>
                                    $("#visit").inputmask({"mask": "99:99"});
                                </script>                        
                        </div>
                        <br>
                        <div>
                            <label>ФИО сотрудника:</label>
                        </div>
                        <br>
                        <div >
                            <select name="edit_full_name_employee" required class="input_min" id="customer_is_free">

                            </select>
                        </div>
                        <br>
                        <div id="div_edit">
                            <div style="display:inline;">
                                <a href="visit.php" class="input_min btn_gray">Назад</a>
                            </div>
                            <div style="display:inline;">
                                <input type="submit" name="update_btn_visit" value="Обновить" class="rectangle_btn btn_green">
                            </div>
                        </div>
                    </div>
                </form>

            <style>
                #div_edit{
                    display:block;
                }
            </style>

            
            
                <?php
        }
    }
?>

        <script src="/script/customer_is_free.js"></script>
        <script>
            let option = "<? echo $row['first_and_last_name'] ?>"; //Получаем переменную из phpmyadmin
            const select = document.querySelector('#select_first_and_last_name').getElementsByTagName('option');
            for (let i = 0; i < select.length; i++) {
                if (select[i].value === option) select[i].selected = true;
            }

            let option_service = "<? echo $row['name_service'] ?>"; //Получаем переменную из phpmyadmin
            const select_service = document.querySelector('#select_name_service').getElementsByTagName('option');
            for (let i = 0; i < select_service.length; i++) {
                if (select_service[i].value === option_service) select_service[i].selected = true;
            }


        </script>

    <script>
        function SetMinDate() 
        {
            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear() + "-" + (month) + "-" + (day);
            $('#DateNow').val('<?php echo $row['date_of_visit'] ?>');
            $('#DateNow').attr('min', today); 
        }
        SetMinDate();
    </script>


    </article>





    <?php 
        require_once "../block/footer.php";
        require_once "../block/asidepanel.php";
        require_once "../block/header.php";
        require_once "../block/asidetable.php";
    ?>

    </div>

<body>
    
</body>
</html>