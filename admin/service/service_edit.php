<?php require_once "../block/head.php"; ?>

<body>
    <div class="grid_edit">

    <article class="article_edit_table">

    <?php 

    if(isset($_POST['edit_btn']))
    {
        $id = $_POST['edit_id'];
        //echo $id;
        $query = "SELECT * FROM service WHERE id_service = '$id' ";
        $result = mysqli_query($connect, $query);
        if(!$result){ echo 'Ошибка в подключении или в запросе'; }

        foreach($result as $row)
        {
            ?>

            <form method="post" action="/admin/query_update.php">
                <div>
                    <input type="hidden" name="edit_id" value="<?php echo $row['id_service'] ?>">

                    <div>
                        <h2>Редактирование усулги</h2>
                    </div>


                <br>
                    <div>
                        <label>Название услуги:</label>
                    <div>
                <br>
                    <div>
                        <input type="text" name="edit_name_service" placeholder="Введите Название услуги" value="<?php echo $row['name_service'] ?>" class="input_min" required>
                    </div>
                <br>
                    <div>
                        <label>Цена:</label>
                    </div>
                <br>
                    <div>
                        <input type="text" name="edit_price_serivce" placeholder="Введите Цену" value="<?php echo $row['price'] ?>" class="input_min" required>
                    </div>
                <br>
                    <div>
                        <label>Описание услуги:</label>
                    </div>
                <br>
                    <div >
                        <textarea name="edit_description_service" cols="30" rows="8" maxlength="1000" placeholder="Введите Описание услуги" class="input_min" required><?php echo $row['description_service'] ?></textarea> 
                    </div>
                <br>
                    <div>
                        <label>Категория:</label>
                    </div>
                    <br>
                    <div>
                        <input type="text" name="edit_category_service" placeholder="Введите Категорию" value="<?php echo $row['category'] ?>" class="input_min" required>
                    </div>
                    <br>
                    <div>
                        <label>Длительность услуги:</label>
                    </div>
                    <br>
                    <div>
                        <select id="select" name="edit_duration_service" required class="input_min">
                            <option value="00:30:00">30м</option>
                            <option value="01:00:00">1ч:00м</option>
                            <option value="01:30:00">1ч:30м</option>
                            <option value="02:00:00">2ч:00м</option>
                            <option value="02:30:00">2ч:30м</option>
                            <option value="03:00:00">3ч:00м</option>
                            <option value="03:30:00">3ч:30м</option>
                            <option value="04:00:00">4ч:00м</option>
                            <option value="04:30:00">4ч:30м</option>
                            <option value="05:00:00">5ч:00м</option>
                        </select>
                    </div>
                    <br>
                    <div id="div_edit">
                        <div style="display:inline;">
                           
                                <a href="service.php" class="input_min btn_gray">Назад</a>
                        
                        </div>
                        <div style="display:inline;">
                            <input type="submit" name="update_btn_service" value="Обновить" class="rectangle_btn btn_green">
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
            let option = "<? echo $row['duration_service'] ?>"; //Получаем переменную из phpmyadmin
            const select = document.querySelector('#select').getElementsByTagName('option');
            for (let i = 0; i < select.length; i++) {
                if (select[i].value === option) select[i].selected = true;
            }
        </script>


    </article>





    <?php 
        require_once "../block/footer.php";
        require_once "../block/asidepanel.php";
        require_once "../block/header.php";
        require_once "../block/asidetable.php";
    ?>

    </div>
    
</body>
</html>