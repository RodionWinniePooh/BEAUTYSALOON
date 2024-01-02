<?php
require_once('../db_connection.php');
require_once "../block/head.php"; ?>

<body>
    <div class="grid_edit">

    <article class="article_edit_table">

    <?php 

    if(isset($_POST['edit_btn']))
    {
        $id = $_POST['edit_id'];
        //echo $id;
        $query = "SELECT * FROM customer WHERE id_customer = '$id' ";
        $result = mysqli_query($connect, $query);
        if(!$result){ echo 'Ошибка в подключении или в запросе'; }

        foreach($result as $row)
        {
            ?>

            <form method="post" action="/admin/query_update.php">
                <div>
                    <input type="hidden" name="edit_id" value="<?php echo $row['id_customer'] ?>">

                    <div>
                        <h2>Редактирование клиента</h2>
                    </div>
                    <br>
                    <div>
                        <label>Email:</label>
                    </div>
                    <br>
                    <div>
                        <input type="email" name="edit_email" placeholder="Введите email" class="input_min" required value="<?php echo $row['email'] ?>">
                    </div>
                    <br>
                    <div>
                        <label>Телефон:</label>
                    </div>
                    <br>
                    <div>
                        <input type="text" id="phone" name="edit_phone_number" title="Используйте числовой формат 29*******(5)" placeholder="Введите телефон" required class="input_min" value="<?php echo $row['phone_number'] ?>">
                    </div>
                    <script>
                        $(function(){
                            //2. Получить элемент, к которому необходимо добавить маску маска подключается через jquery
                            $("#phone").mask("+375(99)999-99-99");
                        });
                    </script>
                    <br>
                    <div>
                        <label>Фамилия и Имя:</label>
                    </div>
                    <br>
                    <div>
                        <input type="text" name="edit_first_and_last_name" placeholder="Введите фамилию и имя" required class="input_min" value="<?php echo $row['first_and_last_name'] ?>">
                    </div>
                    <br>
                    <div id="div_edit">
                        <div style="display:inline;">
                           
                                <a href="customer.php" class="input_min btn_gray">Назад</a>
                        
                        </div>
                        <div style="display:inline;">
                            <input type="submit" name="update_btn_customer" value="Обновить" class="rectangle_btn btn_green">
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