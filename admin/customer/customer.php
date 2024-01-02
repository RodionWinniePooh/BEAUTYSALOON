<?php require_once "../block/head.php"; ?>

<body>
    <div class="grid">

        <?php 
            require_once "../block/asidepanel.php";
            require_once "../block/header.php";
        ?>
        
        <article class="article_search_table">            
            <table>
                <tr>
                    <td>Поиск по клиентам:</td>
                    <td>
                        <input type="text" name="search_text" id="search_text" placeholder=" Поиск" class="input_min">
                    </td>
                </tr>
            </table>
            <?php
            if(isset($_SESSION['success']) && $_SESSION['success'] != '')
            {
                echo '<h2 class="success">'.$_SESSION['success'].'</h2>';
                unset($_SESSION['success']);
            }
            if(isset($_SESSION['error']) && $_SESSION['error'] != '')
            {
                echo '<h2 class="error">'.$_SESSION['error'].'</h2>';
                unset($_SESSION['error']);
            }
            if(isset($_SESSION['warning']) && $_SESSION['warning'] != '')
            {
                echo '<h2 class="warning">'.$_SESSION['warning'].'</h2>';
                unset($_SESSION['warning']);
            }
            ?>
        </article>

    

        <article class="article_view_table container_table_view" id="result">

        </article>
            
        <article class="article_add_table">
            <form method="post" action="/admin/query_add.php">
                    <div>
                        <div>
                            <h2>Добавление клиента</h2>
                        </div>

                        <br>
                        <div>
                            <label>Email:</label>
                        </div>
                        <br>
                        <div>
                            <input type="email" name="email" placeholder="Введите email" class="input_min" required size="35">

                        </div>
                        <br>

                        <div>
                            <label>Телефон:</label>
                        </div>
                        <br>
                        <div>
                            <input type="text" id="phone" name="phone_number" title="Используйте числовой формат 29*******(5)" placeholder="Введите телефон" required class="input_min">
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
                            <input type="text" name="first_and_last_name" placeholder="Введите фамилию и имя" required class="input_min" size="35">
                        </div>
                        <br>
                        <div>
                            <input type="submit" value="Добавить" name="add_customer" class="rectangle_btn btn_green">
                        </div>
                    </div>
                </form>
        </article>

        <article class="article_delete_table">
            <form method="post" action="/admin/query_delete.php">
                <div>
                    <div>
                        <h2>Удаление клиента</h2>
                    </div>
                    <br>
                    <div>
                        <label>Номер клиента:</label>
                    </div>
                    <br>
                    <div>
                        <select name="delete_phone_number" class="input_min" required>
                                <?php 
                                    $query = "SELECT `phone_number` FROM `customer`";
                                    $result = mysqli_query($connect, $query); 
                                    
                                    while ($row = mysqli_fetch_row($result)) {
                                        echo "<option>$row[0]</option>";
                                    }
                                    mysqli_free_result($result);
                                ?>
                        </select>
                    </div>
                    <br>
                    <div>
                        <input type="submit" name="delete_customer" value="Удалить" class="rectangle_btn btn_red">
                    </div>
                </div>
            </form>                         
        </article>


        <style>
            .customer_table{
                width:100%;
            }
            .customer_table>tbody>tr>td:nth-child(1) {
                text-align: center;
            }
            .customer_table>tbody>tr>td:nth-child(2) {
                text-align:center;
            }
            .customer_table>tbody>tr>td:nth-child(4) {
                text-align:  center;
            }
            .customer_table>tbody>tr>td:nth-child(3) {
                text-align:  center;
            }
            .customer_table>tbody>tr>td:nth-child(5) {
                text-align:  center;
            }
            .customer_table>tbody>tr:last-child td:nth-child(2){
                border-bottom: none;
            }

            .container_table_view {
                height: 500px;
                padding: 0px;
                overflow: auto;
            }

            .customer_table>tbody>tr>td:nth-child(2) {
                border-bottom: 2px solid white; /* Горизонтальные линии в таблице */
            }
            /*.employee_table>tbody>tr>td:nth-child(1) {
                border-bottom: 2px solid white; /* Горизонтальные линии в таблице */
            }*/
        </style>

        <aside class="aside_table">
            <form>
                <ol class="widget-list">
                    <li><a href="/admin/service/service.php">     Услуги          </a></li>
                    <li><a href="/admin/employee/employee.php">            Сотрудники      </a></li>
                    <li><a href="/admin/customer/customer.php" id="this_page">            Клиенты         </a></li>
                    <li><a href="/admin/visit/visit.php">               Посещения       </a></li>
                    <li><a href="/admin/material/material.php">            Материалы       </a></li>
                    <li><a href="/admin/consumptionmaterial/consumptionmaterial.php"> Расход материла </a></li>
                    <li><a href="/admin/freeorder/freeorder.php"> Свободные посещения </a></li>
                    <hr>
                    <li>
                        <table>
                        <tr>
                          <td style="vertical-align: middle"><img src="../wallpaper/icon_setting.png" style="max-width:35px; min-width:10px;"></td>
                          <td style="vertical-align: middle"> <a href="/admin/setting.php">Настройки</a></td>
                        </tr>
                        </table>
                    </li>
                </ol>
            </form>  
        </aside>

        <?php 
            require_once "../block/footer.php";
        ?>





    </div>
    <script src="/script/customer_search_view.js"></script>

</body>
</html>