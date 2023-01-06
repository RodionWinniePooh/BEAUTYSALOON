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
        $query = "SELECT * FROM material WHERE id_material = '$id' ";
        $result = mysqli_query($connect, $query);
        if(!$result){ echo 'Ошибка в подключении или в запросе'; }

        foreach($result as $row)
        {
            ?>

            <form method="post" action="/admin/query_update.php">
                <div>
                    <input type="hidden" name="edit_id" value="<?php echo $row['id_material'] ?>">

                    <div>
                        <h2>Редактирование материала</h2>
                    </div>
                    <br>
                    <div>
                        <label>Название материала:</label>
                    </div>
                    <br>
                    <div>
                        <input type="text" name="edit_name_material" placeholder="Введите название" class="input_min" required value="<?php echo $row['name_material'] ?>">
                    </div>
                    <br>
                    <div>
                        <label>Единицы измерения:</label>
                    </div>
                    <br>
                    <div>
                        <select name="edit_unit" id="select_unit" required class="input_min">
                            <option value="мл."> мл.</option>
                            <option value="шт."> шт.</option>
                            <option value="рул.">рул.</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label>Количество материала:</label>
                    </div>
                    <br>
                    <div>
                        <input type="number" name="edit_quantity" placeholder="Введите количество" value="<?php echo $row['quantity'] ?>" required class="input_min" min="1" max="10000">
                    </div>
                    <br>
                    <div>
                        <label>Производитель:</label>
                    </div>
                    <br>
                    <div>
                        <input type="text" name="edit_manufacturer" placeholder="Введите производителя" required class="input_min" value="<?php echo $row['manufacturer'] ?>">
                    </div>
                    <br>
                    <div id="div_edit">
                        <div style="display:inline;">
                           
                                <a href="material.php" class="input_min btn_gray">Назад</a>
                        
                        </div>
                        <div style="display:inline;">
                            <input type="submit" name="update_btn_material" value="Обновить" class="rectangle_btn btn_green">
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
            let option = "<? echo $row['unit'] ?>"; //Получаем переменную из phpmyadmin
            const select = document.querySelector('#select_unit').getElementsByTagName('option');
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

<body>
    
</body>
</html>