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

        $query = "SELECT 
                    Freeorder.id_free_order, 
                    Customer.first_and_last_name, 
                    Service.name_service, 
                    Freeorder.date_of_visit, 
                    Freeorder.time_of_visit 
                  FROM Freeorder INNER JOIN Customer INNER JOIN Service
        ON Freeorder.id_customer = Customer.id_customer AND Freeorder.id_service = Service.id_service WHERE Freeorder.id_free_order = '$id'";



        $result = mysqli_query($connect, $query);
        if(!$result){ echo 'Ошибка в подключении или в запросе'; }

        foreach($result as $row)
        {
            ?>

            <form method="post" action="/admin/query_add.php">
                <div>
                    <input type="hidden" name="edit_id" value="<?php echo $row['id_free_order'] ?>">

                    <div>
                        <h2>Респределение свободного посещения</h2>
                    </div>
                    <br>
                    <div>
                        <label>Фамилия и имя клиента:</label>
                    </div>
                    <br>
                    <div>
                        <input type="text" name="first_and_last_name" placeholder="Введите фамилию и имя" class="input_min" required value="<?php echo $row['first_and_last_name'] ?>">
                    </div>
                    <br>
                    <div>
                        <label>Название услуги:</label>
                    </div>
                    <br>
                    <div>
                        <input type="text" name="name_service" placeholder="Введите название" required class="input_min"  value="<?php echo $row['name_service'] ?>">
                    </div>
                    <br>
                    <div>
                            <label>Дата посещения:</label>
                    </div>
                    <br>
                    <div>
                        <input type="date" id="DateNow" name="date_of_visit" placeholder="Введите дату" class="input_min" required >
                    </div>
                    <br>
                    <div>
                        <label>Время посещения:</label>
                    </div>
                    <br>
                    <div>
                        <label>С 9:00 &nbsp</label>
                        <input type="text" id="visit" name="time_of_visit" value="<?php echo $row['time_of_visit'] ?>" required pattern="(09|10|11|12|13|14|15|16|17|18|19|20|21):([3]{1}|[0]{1})[0]{1}" class="input_min" title="Минуты указывать в формате **:00 или **:30">
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
                        <select name="full_name_employee" required class="input_min" id="customer_is_free">

                        </select>
                    </div>
                    <br>
                    <div id="div_edit">
                        <div style="display:inline;">
                                <a href="freeorder.php" class="input_min btn_gray">Назад</a>
                        </div>
                        <div style="display:inline;">
                            <input type="submit" name="add_visit_through_freeorder" value="Назначить мастера" class="rectangle_btn btn_green">
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