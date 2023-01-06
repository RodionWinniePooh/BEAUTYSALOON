<?
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

<? require_once "../block/head.php"; ?>

<body>
    <div class="grid_edit">

    <article class="article_edit_table">

    <?php 

    if(isset($_POST['edit_btn']))
    {
        $id = $_POST['edit_id'];
        //echo $id;
        $query = "SELECT * FROM employee WHERE id_employee = '$id' ";
        $result = mysqli_query($connect, $query);
        if(!$result){ echo 'Ошибка в подключении или в запросе'; }

        foreach($result as $row)
        {
            ?>

            <form method="post" action="/admin/query_update.php">
                <div>
                    <input type="hidden" name="edit_id" value="<?php echo $row['id_employee'] ?>">

                    <div>
                        <h2>Редактирование сотрудника</h2>
                    </div>
                    <br>
                    <div>
                        <label>ФИО:</label>
                    </div>
                    <br>
                    <div>
                        <input type="text" name="edit_full_name" placeholder="Введите ФИО" required class="input_min" value="<?php echo $row['full_name'] ?>">
                    </div>
                    <br>
                    <div>
                        <label>Адрес:</label>
                    </div>
                    <br>
                    <div>
                        <input type="text" name="edit_address" placeholder="Введите адрес" required class="input_min" value="<?php echo $row['address'] ?>">
                    </div>
                    <br>
                    <div>
                        <label>Телефон:</label>
                    </div>
                    <br>
                    <div>
                        <input type="text" id="phone" name="edit_phone_number" placeholder="Введите номер сотрудника" title="Используйте числовой формат 29*******(5)" required class="input_min" value="<?php echo $row['phone_number'] ?>">
                    </div>
                        <script>
                        $(function(){
                            //2. Получить элемент, к которому необходимо добавить маску маска подключается через jquery
                            $("#phone").mask("+375(99)999-99-99");
                        });
                        </script>
                    <br>
                    <div>
                        <label>Стаж работы:</label>
                    </div>
                    <br>
                    <div>
                        <input type="number" name="edit_length_of_work" placeholder="Введите стаж работы" required class="input_min" min="1" value="<?php echo $row['length_of_work'] ?>">
                    </div>
                    <br>
                    <div>
                        <label>Разряд сотрудника:</label>
                    </div>
                    <br>
                    <div>
                        <select name="edit_rank_of_master" id="select_rank_of_master" required class="input_min">
                            <option value="1">1 разряд</option>
                            <option value="2">2 разряд</option>
                            <option value="3">3 разряд</option>
                            <option value="4">4 разряд</option>
                            <option value="5">5 разряд</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label>Дата приёма на работу:</label>
                    </div>
                    <br>
                    <div>
                        <input type="date" name="edit_date_of_employment" placeholder="Введите дату приёма на рабобу" required class="input_min" value="<?php echo $row['date_of_employment'] ?>">
                    </div>
                    <br>
                    <div id="div_edit">
                        <div style="display:inline;">
                           
                                <a href="employee.php" class="input_min btn_gray">Назад</a>
                        
                        </div>
                        <div style="display:inline;">
                            <input type="submit" name="update_btn_employee" value="Обновить" class="rectangle_btn btn_green">
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

        <script>
            let option = "<? echo $row['rank_of_master'] ?>"; //Получаем переменную из phpmyadmin
            const select = document.querySelector('#select_rank_of_master').getElementsByTagName('option');
            for (let i = 0; i < select.length; i++) {
                if (select[i].value === option) select[i].selected = true;
            }
        </script>


    </article>





    <?
        require_once "../block/footer.php";
        require_once "../block/asidepanel.php";
        require_once "../block/header.php";
        require_once "../block/asidetable.php";
    ?>

    </div>
    
</body>
</html>