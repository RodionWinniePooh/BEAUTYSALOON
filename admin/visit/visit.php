<?php
    session_start();
    require_once "../start.php";
    if(isset($_POST["button_exit"])){
        session_destroy();
        header('Location: /admin/auth.php');
        exit;
    }

    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $database   = "beautysaloon";

    $connect = mysqli_connect($servername, $username, $password, $database)  OR DIE('Ошибка подключения к базе данных');

?>

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
                    <td>Поиск по посещениям:</td>
                    <td>
                        <input type="text" name="search_text" id="search_text" placeholder=" Поиск" class="input_min">
                    </td>
                </tr>
            </table>
            <?php

                if(isset($_SESSION['success']) && $_SESSION['success'] != '')
                {
                    echo '<h2>'.$_SESSION['success'].'</h2>';
                    unset($_SESSION['success']);
                }
                if(isset($_SESSION['status']) && $_SESSION['status'] != '')
                {
                    echo '<h2>'.$_SESSION['status'].'</h2>';
                    unset($_SESSION['status']);
                }
            ?>
        </article>


        

        <article class="article_view_table container_table_view" id="result">

        </article>
            
        <article class="article_add_table">
            <form method="post" action="/admin/query_add.php">
                    <div>
                        <div>
                            <h2>Добавление посещения</h2>
                        </div>

                        <br>
                        <div>
                            <label>Имя и фамилия клиента:</label>
                        </div>
                        <br>
                        <div>
                            <select name="first_and_last_name" class="input_min" required>
                            <?php 
                                    $query = "SELECT `first_and_last_name` FROM `customer` GROUP BY `first_and_last_name`";
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
                            <label>Услуга:</label>
                        </div>
                        <br>
                        <div>
                            <select name="name_service" required class="input_min">
                                <?php 
                                    $query = "SELECT `name_service` FROM `service` GROUP BY `name_service`";
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
                            <label>Дата посещения:</label>
                        </div>
                        <br>
                        <div>
                            <input type="date" id="DateNow" name="date_of_visit" placeholder="Введите дату" class="input_min" required>
                        </div>
                        <br>
                        <div>
                            <label>Время посещения:</label>
                        </div>
                        <br>
                        <div>
                            <label>С 9:00 &nbsp</label>
                            <input type="text" size="6" id="visit" name="time_of_visit" required pattern="(09|10|11|12|13|14|15|16|17|18|19|20|21):([3]{1}|[0]{1})[0]{1}" class="input_min" title="Минуты указывать в формате **:00 или **:30">
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
                        <div>
                            <input type="submit" value="Добавить" name="add_visit" class="rectangle_btn btn_green">
                        </div>
                    </div>
                </form>
        </article>



        <article class="article_delete_table">
                       
        </article>


        <style>
            .material_table{
                width:100%;
            }
            .material_table>tbody>tr>td:nth-child(1) {
                text-align:  center;
            }
            .material_table>tbody>tr>td:nth-child(2) {
                text-align:  center;
            }
            .material_table>tbody>tr>td:nth-child(3) {
                text-align:  center;
            }
            .material_table>tbody>tr>td:nth-child(4) {
                text-align:  center;
            }
            .material_table>tbody>tr>td:nth-child(5) {
                text-align:  center;
            }
            .material_table>tbody>tr>td:nth-child(6) {
                text-align:  center;
            }
            .material_table>tbody>tr>td:nth-child(7) {
                text-align:  center;
            }
            .material_table>tbody>tr>td:nth-child(8) {
                text-align:  center;
            }
            .material_table>tbody>tr:last-child td:nth-child(1){
                border-bottom: none;
            }
            .material_table>tbody>tr:last-child td:nth-child(3){
                border-bottom: none;
            }

            .container_table_view {
                height: 500px;
                padding: 0px;
                overflow: auto;
            }

            .material_table>tbody>tr>td:nth-child(6) {
                border-bottom: 2px solid white; /* Горизонтальные линии в таблице */
            }
            .material_table>tbody>tr>td:nth-child(3) {
                border-bottom: 2px solid white; /* Горизонтальные линии в таблице */
            }
            .material_table>tbody>tr>td:nth-child(1) {
                border-bottom: 2px solid white; /* Горизонтальные линии в таблице */
            }
        </style>

        <aside class="aside_table">
            <form>
                <ol class="widget-list">
                    <li><a href="/admin/service/service.php">     Услуги          </a></li>
                    <li><a href="/admin/employee/employee.php">            Сотрудники      </a></li>
                    <li><a href="/admin/customer/customer.php">            Клиенты         </a></li>
                    <li><a href="/admin/visit/visit.php" id="this_page">               Посещения       </a></li>
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
    <script src="/script/visit_search_view.js"></script>
    <script src="/script/customer_is_free.js"></script>

    <script>
        function SetMinDate() 
        {
            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear() + "-" + (month) + "-" + (day);
            $('#DateNow').val(today);
            $('#DateNow').attr('min', today); 
        }
    SetMinDate();
    </script>
    

</body>
</html>